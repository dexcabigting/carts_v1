<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart; 

class CartsCreate extends Component
{
    public $product;
    public $addItems;
    public $totalAmount;
    public $productPrice;

    protected $rules = [
        'addItems.*.size' => 'required|string',
        'addItems.*.surname' => 'required|string',
        'addItems.*.jersey_number' => 'required|numeric|min:1|max:99',
    ];

    protected $validationAttributes = [
        'addItems.*.size' => '*Jersey Size',
        'addItems.*.surname' => 'Jersey Surname',
        'addItems.*.jersey_number' => 'Jersey Number',
    ];

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

        $this->productPrice =  $this->product->prd_price;

        $this->totalAmount  = $this->productPrice;
    }

    public function render()
    {
        return view('livewire.shop.carts.carts-create');
    }

    public function store()
    {
        $this->validate();

        $quantity = count($this->addItems);

        $cart = Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $this->product->id,
            'quantity' => $quantity,
            'subtotal' => $quantity * $this->product->prd_price,
        ]);

        $cart->cart_items()->createMany($this->addItems);

        $this->addItems = [
            [
                'size' => '',
                'surname' => '',
                'jersey_num' => '',
            ]
        ];

        $this->totalAmount  = $this->productPrice;

        $this->totalAmount  = $this->productPrice;

        session()->flash('success', 'Cart has been created successfully!'); 
    }

    public function addMore()
    {
        $this->addItems[] = [
            'size' => '',
            'surname' => '',
            'jersey_number' => '',
        ];

        $this->totalAmount = $this->totalAmount + $this->productPrice;
    }

    public function removeItem($index)
    {
        unset($this->addItems[$index]);

        $this->addItems = array_values($this->addItems);

        $this->totalAmount = $this->totalAmount - $this->productPrice;
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
