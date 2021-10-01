<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\Product;

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
                'jersey_num' => '',
            ]
        ];
    }

    public function render()
    {
        return view('livewire.shop.carts.carts-create');
    }

    public function store()
    {
        dd($this->addItems);
    }

    public function addMore()
    {
        $this->addItems[] = [
            'size' => '',
            'surname' => '',
            'jersey_num' => '',
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
