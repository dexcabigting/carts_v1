<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\Cart;

class CartsEdit extends Component
{
    public $cartItems = [
        [
            'size' => '',
            'surname' => '',
            'jersey_number' => '', 
        ]
    ];
    public $product;

    public function mount(Cart $id)
    {
        $this->cartItems = $id->cart_items()->get();
    }

    public function render()
    {
        return view('livewire.shop.carts.carts-edit');
    }

    public function closeCartModal()
    {
        $this->dispatchBrowserEvent('cartModalDisplayNone');

        $this->emitUp('closeEditCartModal');
    }
}
