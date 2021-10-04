<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class Carts3d extends Component
{
    public $product;
    public $model;

    public function mount(Product $id)
    {
        $this->product = $id;

        $this->model = Storage::url('public/' . $this->product->prd_3d);
    }

    public function render()
    {
        return view('livewire.shop.carts.carts3d');
    }
}
