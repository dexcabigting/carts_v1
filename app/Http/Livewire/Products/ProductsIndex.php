<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public $checkedProducts;
    public $category;
    public $categories = [];
    public $selectAll = false;
    public $createModal = false;
    public $editModal = false;
    public $deleteModal = false;
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
        $this->categories = Category::all();
    }

    public function render()
    {
        $products = $this->products->paginate(6);

        return view('livewire.products.products-index', compact('products'));
    }

    public function getProductsProperty()
    {
        $search = '%' . $this->search . '%';

        $sortColumn = $this->sortColumn;

        $sortDirection = $this->sortDirection;

        $category = $this->category;

        /**
         * @var Category
         */
        $categories = $this->categories;

        $categories = $categories->pluck('id')->toArray();

        $category = is_string($category) && $category != 'All' ? [$category] : $categories;

        return Product::with(['category', 'fabric', 'product_variants', 'product_stocks'])
            ->where('prd_name', 'like', $search)
            ->whereIn('category_id', $category)
            ->orderBy($sortColumn, $sortDirection);
    }

    public function updatedSelectAll($value)
    {
        $search = '%' . $this->search . '%';

        if ($value) {
            $this->checkedProducts = Product::where('prd_name', 'like', $search)
                ->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->flip()
                ->map(fn ($item) => true)
                ->toArray();
        } else {
            $this->checkedProducts = [];
        }

    }

    public function updatedCheckedProducts()
    {
        $this->selectAll = false;

        $this->checkedProducts = array_filter($this->checkedProducts);

    }

    public function updatedSearch()
    {
        if(is_array($this->checkedProducts)) {
            $this->checkedProducts = [];

            $this->selectAll = false;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
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
}
