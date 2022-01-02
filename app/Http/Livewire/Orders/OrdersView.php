<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;

use App\Events\OrderStatusUpdated;

use App\Models\Order;

use Twilio\Rest\Client;

class OrdersView extends Component
{
    public $orderId;
    public $orderStatuses;
    public $selectedStatus;
    public $proofOfPayment = 0;

    protected $rules = [
        'message' => 'required|string|max:160'
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
        $this->order->update([
            'status' => $this->selectedStatus,
        ]);

        if($this->selectedStatus == "Shipping") {
            $this->validate();

            $this->textUser();
        }

        $order = $this->order->first();

        event(new OrderStatusUpdated($order));

        session()->flash('success', 'User has been notified!');

        $this->emitUp('refreshParent');
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
        $message = $this->message;

        // dd($name, $phone);

        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_NUMBER');

        $client = new Client($accountSid, $authToken);

        try {
            $client->messages->create(
                $phone,
                [
                    "body" => "Hello " . $name . "! ". $message,
                    "from" => $twilioNumber
                ]
            );
            Log::info('Message sent to ' . $phone);
        } catch(TwilioException $e) {
            Log::error(
                'Could not send SMS notification.' .
                ' Twilio replied with: ' . $e
            );
        }
    }   
}
