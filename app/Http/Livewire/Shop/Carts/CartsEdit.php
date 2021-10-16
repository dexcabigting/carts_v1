<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;

class CartsEdit extends Component
{
    public $cartItems = [
        [
            'size' => '',
            'surname' => '',
            'jersey_number' => '', 
        ]
    ];
    public $cartVariant;
    public $totalAmount;

    public function mount(Cart $id)
    {
        $this->cartVariant = $id->load('product_variant');

        $this->totalAmount = $this->cartVariant->subtotal;

        $this->cartItems = $id->cart_items()->get()->toArray();
    }

    public function render()
    {
        // dd($this->cartItems);
        return view('livewire.shop.carts.carts-edit');
    }

    public function closeCartModal()
    {
        $this->dispatchBrowserEvent('cartModalDisplayNone');

        $this->emitUp('closeEditCartModal');
    }
}
