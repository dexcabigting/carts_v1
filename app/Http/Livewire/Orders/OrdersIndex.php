<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;

class OrdersIndex extends Component
{
    public function render()
    {
        $orders = $this->orders->paginate(10);

        // $orders = $this->orders->get();

        // dd($orders->toArray());

        if(auth()->user()->role_id == 1) {
            return view('livewire.orders.orders-index', compact('orders'))->layout('layouts.app');
        } else {    
            return view('livewire.orders.orders-index-user', compact('orders'))->layout('layouts.app-user');
        }
    }

    public function getOrdersProperty()
    {
        if(auth()->user()->role_id == 1) {
            return Order::all();
        } else {
            return Order::with(['order_variants:id,order_id,amount,product_variant_id', 
                                'order_variants.product_variant' => function ($query) {
                                    $query->select('id', 'product_id', 'prd_var_name')
                                    ->with(['product:id,prd_name']);
                            }])
                            ->where('user_id', auth()->user()->id)
                            ->withCount('order_items');              
        }
    }
}
