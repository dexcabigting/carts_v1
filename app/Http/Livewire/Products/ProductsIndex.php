<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public $prompt;
    
    public $createModal = 1;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeCreateModal',
        'closeUpdateModal'
    ];

    public function render()
    {
        $products = $this->products->paginate(6);

        return view('livewire.products.products-index', compact('products'));
    }

    public function getProductsProperty()
    {
        return Product::orderBy('prd_name');
    }

    public function openCreateModal()
    {
        $this->createModal = true;
    }

    public function closeCreateModal()
    {
        $this->createModal = false;
    }
}
