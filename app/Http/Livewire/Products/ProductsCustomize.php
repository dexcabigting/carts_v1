<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

use App\Models\Fabric;

class ProductsCustomize extends Component
{
    public function render()
    {
        $fabrics = Fabric::select('id', 'fab_name')->get();

        return view('livewire.products.products-customize', compact('fabrics'))->layout('layouts.app-user');
    }
}
