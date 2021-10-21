<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use Luigel\Paymongo\Facades\Paymongo;

class OrdersIndex extends Component
{
    public function render()
    {
        // dd($payments = Paymongo::payment()->all()->toArray());
        return view('livewire.orders.orders-index')->layout('layouts.app');
    }

    public function cancelIntent()
    {
        $paymentIntent = Paymongo::paymentIntent()->find('pi_W1kuEjPYuJVYxVAm6rgmBvvH');
        $cancelledPaymentIntent = $paymentIntent->cancel();

        // pi_W1kuEjPYuJVYxVAm6rgmBvvH
        // pi_bN6AoeinPMX2xy6Me2NhG5U6
    }
}
