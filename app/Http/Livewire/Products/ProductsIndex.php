<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Product;
use App\Models\Category;
use App\Models\Fabric;

class ProductsIndex extends Component
{
    use WithPagination;

    public $checkedProducts;
    public $category;
    public $fabric;
    public $categories = [];
    public $fabrics = [];
    public $selectAll = false;
    public $createModal = 0;
    public $editModal = 0;
    public $deleteModal = 0;
    public $productId;
    public $search;
    public $sortColumn = 'prd_name';
    public $sortDirection = 'asc';

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

        return Product::with(['category', 'fabric', 'product_variants', 'product_stocks'])
            ->where('prd_name', 'like', $search)
            ->whereIn('category_id', $category)
            ->whereIn('fabric_id', $fabric)
            ->orderBy($sortColumn, $sortDirection);
    }

    public function updatedSelectAll($value)
    {    
        extract($this->setProperties());

        if ($value) {
            $this->checkedProducts = Product::where('prd_name', 'like', $search)
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

        $sortColumn = $this->sortColumn;

        $sortDirection = $this->sortDirection;

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

        return compact('search', 'sortColumn', 'sortDirection', 'category', 'fabric', 'fabrics', 'categories');
    }
}
