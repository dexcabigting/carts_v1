<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;

class OrdersIndex extends Component
{
    public function render()
    {
        $orders = $this->orders->paginate(6);

        if(auth()->user()->role_id == 1) {
            
            return view('livewire.orders.orders-index', compact('orders'))->layout('layouts.app');
        } else {
            
            return view('livewire.orders.orders-index', compact('orders'))->layout('layouts.app-user');
        }
    }

    public function getOrdersProperty()
    {
        if(auth()->user()->role_id == 1) {
            return Order::all();
        } else {
            return auth()->user()->orders()->where('status', 'pending');
        }
    }
}
