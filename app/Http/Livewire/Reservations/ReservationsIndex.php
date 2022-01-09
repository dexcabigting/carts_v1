<?php

namespace App\Http\Livewire\Reservations;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\TshirtDetails;

class ReservationsIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $tshirt_details = TshirtDetails::where('user_id', auth()->user()->id)->paginate(10);

        return view('livewire.reservations.reservations-index', compact('tshirt_details'))->layout('layouts.app-user');
    }
}
