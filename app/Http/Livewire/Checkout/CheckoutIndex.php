<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use App\Models\Cart;

class CheckoutIndex extends Component
{
    public $userCartItems;
    public $userCart;
    public $price;
    public $cartQuantity;

    public function mount(Cart $id)
    {
        $this->userCart = $id->load('product_variant.product');

        $this->price = $this->userCart->product_variant->product->prd_price;
        
        $this->userCartItems = $id->cart_items()->get()->countBy('size')->toArray();

        $this->cartQuantity = array_sum($this->userCartItems);

        // dd($this->userCartItems);
    }

    public function render()
    {
        return view('livewire.checkout.checkout-index')->layout('layouts.app-user');
    }
}
