<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Fabric;
use Livewire\WithPagination;

class ShopIndex extends Component
{
    use WithPagination;

    public $search; 
    public $cartId;
    public $category;
    public $fabric;
    public $categories = [];
    public $fabrics = [];
    public $cartModal = false;

    protected $listeners = [
        'openCartModal',
        'closeCartModal'
    ];

    public function mount()
    {

        $this->categories = Category::all();
        $this->fabrics = Fabric::all();
    }

    public function render()
    {
        $products = $this->products->paginate(6);

        return view('livewire.shop.shop-index', compact('products'));
    }

    public function getProductsProperty()
    {
        $search = '%' . $this->search . '%';

        $category = $this->category;
        $fabric = $this->fabric;

        /**
         * @var Category
         */
        $categories = $this->categories;

        /**
         * @var Fabric
         */
        $fabrics = $this->fabrics;

        $categories = $categories->pluck('id')->toArray();
        $fabrics = $fabrics->pluck('id')->toArray();

        $category = is_string($category) && $category != 'All' ? [$category] : $categories;
        $fabric = is_string($fabric) && $fabric != 'All' ? [$fabric] : $fabrics;

        return Product::with('category')
            ->where('prd_name', 'like', $search)
            ->whereIn('category_id', $category)
            ->whereIn('fabric_id', $fabric);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function likeProduct($id)
    {
        
    }

    public function unlikeProduct($id)
    {
        
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
