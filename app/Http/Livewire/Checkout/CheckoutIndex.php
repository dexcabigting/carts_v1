<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use App\Models\Cart;

class CheckoutIndex extends Component
{
    public $userCartItems;
    public $userCart;
    public $userCarts;
    public $price;
    public $cartQuantity;
    public $cart;
    public $carts = [];

    public function mount($ids)
    {
        $this->carts = json_decode($ids);

        $this->userCarts = auth()->user()->userCarts($this->carts)->with('product_variant.product')->get();

        $this->cartQuantity = auth()->user()->userCartItems($this->carts)->count();
    }

    public function render()
    {
        return view('livewire.checkout.checkout-index')->layout('layouts.app-user');
    }
}
