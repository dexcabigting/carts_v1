<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;

use App\Events\OrderStatusUpdated;

use App\Models\Order;
use App\Models\OrderVariant;
use App\Models\ProductVariant;
use App\Models\ProductStock;

use Twilio\Rest\Client;

use Exception;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrdersView extends Component
{
    public $orderId;
    public $orderStatuses;
    public $selectedStatus;
    public $proofOfPayment = false;
    public $dateOfArrival;

    protected $rules = [
        'dateOfArrival' => 'required|date'
    ];

    public function mount($id)
    {
        $this->orderId = $id;

        $this->selectedStatus = $this->order->first()->status;

        $this->orderStatuses = [
            'Pending',
            'Rejected',
            'Approved',
            'To ship',
            'Shipping',
            'Delivered',
        ];

        $this->dateOfArrival = now()->toDateString();

        // dd($this->orderStatuses);
    }

    public function render()
    {
        $userOrder = $this->order->first();

        return view('livewire.orders.orders-view', compact('userOrder'));
    }

    public function getOrderProperty()
    {
        // if(auth()->user()->role_id == 1) {
            return Order::where('id', $this->orderId)
                            ->with(['user:id,name,email,phone', 
                                'order_variants:id,order_id,amount,product_variant_id', 
                                'order_variants.product_variant' => function ($query) {
                                    $query->select('id', 'product_id', 'prd_var_name')
                                    ->with(['product:id,prd_name']);
                            }, 'user_address:id,province,city,barangay,home_address',   
                             'order_variants.order_items'])
                            ->withCount('order_items');
        // }
    }

    public function updateStatus()
    {
        // dd($this->dateOFArrival);

        try {
            DB::transaction(function() {
                $this->order->update([
                    'status' => $this->selectedStatus,
                ]);

                if($this->selectedStatus == "Approved") {
                    $this->updateStocks();
                } elseif($this->selectedStatus == "Shipping") {
                    $this->validate();

                    $this->textUser();
                }

                $order = $this->order->first();

                event(new OrderStatusUpdated($order));

                session()->flash('success', 'User has been notified!');

                $this->emitUp('refreshParent');
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function proofOfPaymentOrCustomerInfo()
    {
        if($this->proofOfPayment == 0) {
            $this->proofOfPayment = 1;
        } else {
            $this->proofOfPayment = 0;
        }
    }

    public function closeViewModal()
    {
        $this->dispatchBrowserEvent('viewModalDisplayNone');
        
        $this->emitUp('closeViewModal');
    }

    protected function textUser()
    {
        $name = $this->order->first()->user->name;
        $phone = $this->order->first()->user->phone;
        $date = Carbon::parse($this->dateOfArrival)->toFormattedDateString();
        $message = "Hello! " . $name . ", your order is expected to arrive in " . $date . ' - EJ Ezon';

        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_FROM');

        $client = new Client($accountSid, $authToken);

        $client->messages->create(
            "+" . $phone,
            [
                "body" => $message,
                "from" => $twilioNumber
            ]
        );
    }   

    protected function updateStocks()
    {
        $orderId = $this->orderId;

        $orderVariants = OrderVariant::where('order_id', $orderId)->get();

        $orderVariants->each(function($orderVariant) {
            $variant = ProductVariant::where('id', $orderVariant->product_variant_id)->first();

            $productStock = ProductStock::where('product_variant_id', $orderVariant->product_variant_id)->first();

            $orderItems = $orderVariant->orderItemSizes()->toArray();

            foreach($orderItems as $size => $qty) {
                $productStock->decrement($size, $qty);

                $variant->increment('sold_count', $qty);
            }
        });

        // $productStock = ProductStock::where('product_variant_id', $cartToBeMoved->product_variant_id)->first();
        // $userCartItem = auth()->user()->carts()->where('id', $cartToBeMoved->id)->first()->cartItemSizes()->toArray();

        // foreach($userCartItem as $size => $qty) {
        //     $productStock->decrement($size, $qty);
        // }
    }
}
