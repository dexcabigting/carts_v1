<?php

namespace App\Http\Livewire\Reservations;

use Livewire\Component;

use App\Models\TshirtDetails;

class ReservationsIndex extends Component
{
    public function render()
    {
        $tshirt_details = TshirtDetails::where('customer_name', '"'. auth()->user()->name . '"' )->get();

        return view('livewire.reservations.reservations-index', compact('tshirt_details'))->layout('layouts.app-user');
    }
}
