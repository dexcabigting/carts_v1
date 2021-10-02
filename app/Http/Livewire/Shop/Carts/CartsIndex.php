<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\User;

class CartsIndex extends Component
{
    public $userCarts = [];

    public function mount()
    {
        $this->userCarts = auth()->user()->carts;
    }

    public function render()
    {
        return view('livewire.shop.carts.carts-index');
    }
}
