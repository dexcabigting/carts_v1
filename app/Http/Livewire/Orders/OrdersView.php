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
            "Pending",
            "Rejected",
            "Approved",
            "To ship",
            "Shipping",
            "Delivered",
        ];

        $key = array_search($this->selectedStatus, $this->orderStatuses);

        for($i = 0; $i < $key; $i++) {
            array_shift($this->orderStatuses);
        }

        $this->dateOfArrival = now()->toDateString();

        // dd($this->orderStatuses);
    }

    public function render()
    {
        $userOrder = $this->order->first();

        // dd($userOrder);

        return view('livewire.orders.orders-view', compact('userOrder'));
    }

    public function notifyUser()
    {
        $order = $this->order->first();
        
        event(new OrderStatusUpdated($order));
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
                            ->withCount('order_items')
                            ->withTrashed();
        // }
    }

    public function getOrderVariantProperty()
    {
        return OrderVariant::where('order_id', $this->orderId);
    }

    public function updateStatus()
    {
        try {
            DB::transaction(function() {
                if($this->selectedStatus == $this->order->first()->status) {
                    session()->flash('fail', 'Please select another order status.');
                    return;
                } 

                $this->order->update([
                    'status' => $this->selectedStatus,
                ]);

                $this->notifyUser();

                if($this->selectedStatus == "Approved") {
                    $this->checkStocks();

                    $this->updateStocks();
                } elseif($this->selectedStatus == "Shipping") {
                    $this->validate();

                    $this->assignDateOfArrival();

                    $this->textUser();
                } elseif($this->selectedStatus == "Rejected") {
                    $this->deleteUserOrder();

                    $this->textUser();
                }

                $this->mount($this->order->first()->id);

                $this->emitUp('refreshParent'); 

                session()->flash('success', 'User has been notified!');
            });
        } catch(Exception $error) {
            if($error->getMessage()) {
                session()->flash('fail', $error->getMessage());
            } else {
                session()->flash('fail', 'An error occured! ' . $error);
            }   
        }  
    }

    public function proofOfPaymentOrCustomerInfo()
    {
        if($this->proofOfPayment == false) {
            $this->proofOfPayment = true;
        } else {
            $this->proofOfPayment = false;
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

        if($this->selectedStatus == "Rejected") {
            $message = "Hello " . $name . "!, your order is rejected. We will refund your GCash payment in a moment. -EJ Ezon";
        } else {
            $date = Carbon::parse($this->dateOfArrival)->toFormattedDateString();

            $message = "Hello " . $name . "!, your order is expected to arrive in " . $date . '. - EJ Ezon';
        }

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

    protected function checkStocks()
    {
        $name = $this->order->first()->user->name;

        $orderVariants = $this->order_variant->get();

        foreach($orderVariants as $orderVariant) {
            $productStock = ProductStock::where('product_variant_id', $orderVariant->product_variant_id)->first();
            $originalStocks = $productStock->sizes->toArray();

            $orderItems = $orderVariant->order_items()->get();

            $variantStocks = array_count_values(array_column($orderItems->toArray(), 'size'));

            foreach($variantStocks as $size => $count) {
                $originalCountSize = $originalStocks[$size];

                if($count > $originalCountSize) {
                    $message = 'The quantity of ' . $size . ' exceeded the available size! Reject the order and refund ' . $name . '\'s payment.';
                    throw new Exception($message);
                }
            }  
        }  
    }

    protected function updateStocks()
    {
        $orderId = $this->orderId;

        $orderVariants = OrderVariant::where('order_id', $orderId)->get();

        $orderVariants->each(function($orderVariant) {
            $variant = ProductVariant::where('id', $orderVariant->product_variant_id)->first();

            $productStocks = ProductStock::where('product_variant_id', $orderVariant->product_variant_id)->first();

            $orderItems = $orderVariant->orderItemSizes()->toArray();

            foreach($orderItems as $size => $qty) {
                $productStocks->decrement($size, $qty);

                $variant->increment('sold_count', $qty);
            }
        });
    }

    protected function deleteUserOrder()
    {
        $this->order->delete();
    }

    public function assignDateOfArrival()
    {
        $this->order->update(['date_of_arrival' => $this->dateOfArrival]);
    }
}
