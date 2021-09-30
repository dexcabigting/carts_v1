<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ShopIndex extends Component
{
    use WithPagination;

    public $search; 
    public $cartId;
    public $cartModal = false;

    protected $listeners = [
        'openCartModal',
        'closeCartModal'
    ];

    public function render()
    {
        $products = $this->products->paginate(6);

        return view('livewire.shop.shop-index', compact('products'));
    }

    public function getProductsProperty()
    {
        $search = '%' . $this->search . '%';

        return Product::where('prd_name', 'like', $search);
    }

    public function openCartModal($id)
    {
        $this->cartId = $id;

        $this->cartModal = true;
    }

    public function closeCartModal()
    {
        $this->cartModal = false;
    }    
}
