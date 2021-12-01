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

        // $this->userOrder = Order::where('id', $id)
        //                     ->with(['user:id,name,email,phone', 
        //                         'order_variants:id,order_id,amount,product_variant_id', 
        //                         'order_variants.product_variant' => function ($query) {
        //                             $query->select('id', 'product_id', 'prd_var_name')
        //                             ->with(['product:id,prd_name']);
        //                     }, 'order_variants.order_items'])
        //                     ->withCount('order_items')
        //                     ->first();
        // dd($this->orderStatuses, $this->userOrder->status);
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

    public function closeViewModal()
    {
        $this->dispatchBrowserEvent('viewModalDisplayNone');
        
        $this->emitUp('closeViewModal');
    }
}
