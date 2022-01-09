<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;

class SalesIndex extends Component
{
    public $premadeOrCustom = "Premade";

    public function render()
    {
        return view('livewire.sales.sales-index')->layout('layouts.app');
    }
}
