<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductLike;
use App\Models\Category;
use App\Models\Fabric;
use Exception;
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
    public $min = null;
    public $max = null;
    public $sortBy = 'prd_name';
    public $orderBy = 'asc';

    protected $rules = [
        'min' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|between:0,99999.99',
        'max' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|between:0,99999.99'
    ];

    protected $validationAttributes = [
        'min' => 'minimum price',
        'max' => 'maximum price'
    ];

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

        // dd($this->products->get()->toArray());

        return view('livewire.shop.shop-index', compact('products'))->layout('layouts.app-user');
    }

    public function getProductsProperty()
    {
        $min = 00.00;

        $max = 99999.99;

        $search = '%' . $this->search . '%';
        
        try {
            $this->validate();

            $min = (empty($this->min)) ? 00.00 : $this->min;
            $max = (empty($this->max)) ? 99999.99 : $this->max;
        } catch(Exception $error) {

        }

        $sortBy = $this->sortBy;
        $orderBy = $this->orderBy;

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

        $category = is_string($category) && $category != 'All' ? [+$category] : $categories;
        $fabric = is_string($fabric) && $fabric != 'All' ? [+$fabric] : $fabrics;

        $sizes = [
            '2XS',
            'XS',
            'S',
            'M',
            'L',
            'XL',
            '2XL'
        ];

        return Product::with('category:id,ctgr_name', 'fabric:id,fab_name')
            ->with(['product_variants' => function ($query) use ($sizes) {
                $query->select('id', 'product_id', 'front_view', 'back_view')
                ->with(['product_stock']);
            }])
            ->whereHas('product_variants', function ($query) use($sizes) {
                $query->whereDoesntHave('product_stock', function ($query) use($sizes){
                    foreach($sizes as $size) {
                        $query->where($size, '=', 0);
                    }
                });
            })
            ->withSum('product_variants', 'sold_count')
            ->where('prd_name', 'like', $search)
            ->where('prd_price', '>=', $min)
            ->where('prd_price', '<=', $max)
            ->whereIn('products.category_id', $category)
            ->whereIn('fabric_id', $fabric)
            ->orderBy($sortBy, $orderBy);
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingFabric()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedMin()
    {
        $this->validateOnly('min');
        $this->resetPage();
    }

    public function updatedMax()
    {
        $this->validateOnly('max');
        $this->resetPage();
    }

    public function likeProduct(Product $id)
    {
        $user = auth()->id();
        $product = $id;

        if(!$product->likes()->where('user_id', $user)->exists()) {
            ProductLike::create([
                'user_id' => $user,
                'product_id' => $product->id,
            ]);
        }
    }

    public function unlikeProduct(Product $id)
    {
        $user = auth()->id();
        $product = $id;
        
        if($product->likes()->where('user_id', $user)->exists()) {
            ProductLike::where('user_id', $user)
                ->where('product_id', $product->id)
                ->delete();
        }
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

    public function resetFilter()
    {
        $this->reset(['search', 'min', 'max', 'category', 'fabric', 'sortBy', 'orderBy']);
        $this->resetErrorBag();
    }
}
