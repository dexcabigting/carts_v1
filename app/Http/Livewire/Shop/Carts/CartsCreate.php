<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart; 

class CartsCreate extends Component
{
    public $product;
    public $addItems;

    public function mount(Product $id)
    {
        $this->product = $id;

        $this->addItems = [
            [
                'size' => '',
                'surname' => '',
                'jersey_number' => '',
            ]
        ];
    }

    public function render()
    {
        return view('livewire.shop.carts.carts-create');
    }

    public function store()
    {
        $cart = Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $this->product->id,
        ]);

        $cart->cart_items()->createMany($this->addItems);

        session()->flash('success', 'Cart has been created successfully!'); 
    }

    public function addMore()
    {
        $this->addItems[] = [
            'size' => '',
            'surname' => '',
            'jersey_number' => '',
        ];
    }

    public function removeItem($index)
    {
        unset($this->addItems[$index]);

        $this->addItems = array_values($this->addItems);
    }

    public function closeCartModal()
    {
        $this->addItems = [
            [
                'size' => '',
                'surname' => '',
                'jersey_num' => '',
            ]
        ];

        $this->dispatchBrowserEvent('cartModalDisplayNone');

        $this->emitUp('closeCartModal');
    }

    
}
