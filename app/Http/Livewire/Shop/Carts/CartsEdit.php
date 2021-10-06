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
    public $product;
    public $product_sizes;

    public function mount(Cart $id)
    {
        $this->cartItems = $id->cart_items()->get()->toArray();

        $this->product = Product::where('id', $id->product_id)->first();

        $this->product_sizes = $this->product->product_stock->sizes->toArray();
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
