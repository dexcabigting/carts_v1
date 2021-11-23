<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;

class OrdersView extends Component
{
    public $userOrder; 

    public function mount($id)
    {
        $this->userOrder = Order::where('id', $id)
                            ->with(['order_variants:id,order_id,amount,product_variant_id', 
                                'order_variants.product_variant' => function ($query) {
                                    $query->select('id', 'product_id', 'prd_var_name')
                                    ->with(['product:id,prd_name']);
                            }, 'order_variants.order_items'])
                            ->withCount('order_items')
                            ->first();
    }

    public function render()
    {
        return view('livewire.orders.orders-view');
    }

    public function closeViewModal()
    {
        $this->dispatchBrowserEvent('viewModalDisplayNone');
        
        $this->emitUp('closeViewModal');
    }
}
