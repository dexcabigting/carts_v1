<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Product;
use App\Models\Category;
use App\Models\Fabric;

use Exception;

use Illuminate\Support\Facades\DB;

class ProductsIndex extends Component
{
    use WithPagination;

    public $checkedProducts;
    public $category;
    public $fabric;
    public $categories = [];
    public $fabrics = [];
    public $selectAll = false;
    public $productId;
    public $search;
    public $sortBy = 'prd_name';
    public $orderBy = 'asc';
    public $createModal = false;
    public $editModal = false;
    public $deleteModal = false;
    public $query = 'products';

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeCreateModal',
        'closeEditModal',
        'closeDeleteModal',
        'cleanse',
        'unsetCheckedProducts',
    ];

    public function mount()
    {
        $this->checkedProducts = [];

        $this->productId = [];

        $this->categories = Category::all('id', 'ctgr_name');

        $this->fabrics = Fabric::all('id', 'fab_name');
    }

    public function render()
    {
        $products = $this->products->paginate(6);

        return view('livewire.products.products-index', compact('products'));
    }

    public function getProductsProperty()
    {
        extract($this->setProperties());

        if($this->query == 'products') {
            $query = Product::query()->with(['category', 'fabric', 'product_variants', 'product_stocks']);
        } else {
            $query = Product::onlyTrashed()->with(['category', 'fabric', 'deleted_product_variants', 'deleted_product_stocks']);
        }

        return $query
            ->where('prd_name', 'like', $search)
            ->whereIn('category_id', $category)
            ->whereIn('fabric_id', $fabric)
            ->orderBy($sortBy, $orderBy);
    }

    public function updatedSelectAll($value)
    {    
        extract($this->setProperties());

        if($this->query == 'products') {
            $query = Product::query();
        } else {
            $query = Product::onlyTrashed();
        }

        if ($value) {
            $this->checkedProducts = $query
                ->where('prd_name', 'like', $search)
                ->whereIn('category_id', $category)
                ->whereIn('fabric_id', $fabric)
                ->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->flip()
                ->map(fn ($item) => true)
                ->toArray();
        } else {
            $this->checkedProducts = [];
        }
    }

    public function getCheckedKeysProperty()
    {
        return array_keys($this->checkedProducts);
    }

    public function updatedCheckedProducts()
    {
        $this->selectAll = false;

        $this->checkedProducts = array_filter($this->checkedProducts);
    }

    public function updatingSearch()
    {
        $this->disablerAndPageResetter();
    }

    public function updatingQuery()
    {
        $this->resetPage();

        $this->checkedProducts = [];

        $this->selectAll = false;
    }

    public function updatingCategory()
    {
        $this->disablerAndPageResetter();
    }

    public function updatingFabric()
    {
        $this->disablerAndPageResetter();
    }

    public function openCreateModal()
    {
        $this->createModal = true;
    }

    public function closeCreateModal()
    {
        $this->createModal = false;
    }

    public function openEditModal($id)
    {
        $this->productId = $id;

        $this->editModal = true;
    }

    public function closeEditModal()
    {
        $this->editModal = false;
    }

    public function openDeleteModal($id)
    {
        $this->productId = $id;

        $this->deleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
    }

    public function cleanse()
    {
        $this->checkedProducts = [];

        $this->selectAll = false;
    }

    public function unsetCheckedProducts($ids)
    {
        if (is_array($this->checkedProducts)) {
            foreach ($ids as $id) {
                unset($this->checkedProducts['$id']);
            }
        }
    }

    private function disablerAndPageResetter()
    {
        if(is_array($this->checkedProducts)) {
            $this->checkedProducts = [];

            $this->selectAll = false;

            $this->resetPage();
        }
    }

    private function setProperties()
    {
        $search = '%' . $this->search . '%';

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

        $fabrics =  $fabrics->pluck('id')->toArray();

        $category = is_string($category) && $category != "All" ? [$category] : $categories;

        $fabric = is_string($fabric) && $fabric != "All" ? [$fabric] : $fabrics;

        return compact('search', 'sortBy', 'orderBy', 'category', 'fabric', 'fabrics', 'categories');
    }

    public function resetFilter()
    {
        $this->reset(['search', 'sortBy', 'orderBy', 'category', 'fabric']);
    }

    public function restoreProduct($id)
    {
        try {
            DB::transaction(function() use($id) {
                $product = Product::onlyTrashed()->findOrFail($id);

                $product->restore();

                $productVariants = $product->product_variants()->onlyTrashed();

                $productVariants->each(function($productVariant) {
                    $productVariant->restore();

                    $productStock = $productVariant->product_stock()->onlyTrashed();

                    $productStock->restore();
                });

                $likes = $product->likes()->onlyTrashed();

                $likes->each(function($like) {
                    $like->restore();
                });

                $this->emit('unsetCheckedProducts', [$id]);

                $this->emit('cleanse');
            });
        } catch(Exception $error) {
            
        }
    }

    public function restoreProducts()
    {
        try {
            DB::transaction(function() {
                $productIds = $this->checked_keys;

                $products = Product::onlyTrashed()->whereIn('id', $productIds)->get();

                $products->each(function($product) {
                    $product->restore();

                    $productVariants = $product->product_variants()->onlyTrashed();

                    $productVariants->each(function($productVariant) {
                        $productVariant->restore();

                        $productStock = $productVariant->product_stock()->onlyTrashed();

                        $productStock->restore();
                    });

                    $likes = $product->likes()->onlyTrashed();

                    $likes->each(function($like) {
                        $like->restore();
                    });
                });

                $this->emit('unsetCheckedProducts', $productIds);

                $this->emit('cleanse');
            });
        } catch(Exception $error) {

        }
    }
}
