<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use Luigel\Paymongo\Facades\Paymongo;

class OrdersIndex extends Component
{
    public function render()
    {
        dd($payments = Paymongo::payment()->all());
        return view('livewire.orders.orders-index')->layout('layouts.app');
    }
}
