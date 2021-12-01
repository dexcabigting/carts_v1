<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;

class OrdersView extends Component
{
    // public $userOrder; 
    public $orderId;
    public $orderStatuses;
    public $selectedStatus;
    // public $orderDetails = 1;
    public $proofOfPayment = 0;

    public function mount($id)
    {
        $this->orderId = $id;

        $this->selectedStatus = $this->order->first()->status;

        $this->orderStatuses = [
            'Pending',
            'Approved',
            'To ship',
            'Shipping',
            'Delivered',
        ];
    }

    public function render()
    {
        $userOrder = $this->order->first();

        return view('livewire.orders.orders-view', compact('userOrder'));
    }

    public function getOrderProperty()
    {
        return Order::where('id', $this->orderId)
                            ->with(['user:id,name,email,phone', 
                                'order_variants:id,order_id,amount,product_variant_id', 
                                'order_variants.product_variant' => function ($query) {
                                    $query->select('id', 'product_id', 'prd_var_name')
                                    ->with(['product:id,prd_name']);
                            }, 'order_variants.order_items'])
                            ->withCount('order_items');
    }

    public function updateStatus()
    {
        $this->userOrder->update([
            'status' => $this->selectedStatus,
        ]);

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
}
