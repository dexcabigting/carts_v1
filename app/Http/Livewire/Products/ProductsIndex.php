<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;
    
    public $checkedProducts;
    public $selectAll = false;
    public $createModal = 0;
    public $editModal = 0;
    public $deleteModal = 0;
    public $imageId;
    public $productId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'refreshImage',
        'closeCreateModal',
        'closeEditModal',
        'closeDeleteModal',
        'cleanse',
        'unsetCheckedProducts',
        'arrayDiffCheckedProducts',
    ];

    public function mount()
    {
        $this->checkedProducts = [];
    }

    public function render()
    {
        $products = $this->products->paginate(6);

        return view('livewire.products.products-index', compact('products'));
    }

    public function getProductsProperty()
    {
        return Product::orderBy('prd_name');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checkedProducts = Product::select('id')
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

    // public function unsetCheckedProducts($ids)
    // {
    //     if (is_array($this->checkedProducts)) {
    //         foreach ($ids as $id) { 
    //             unset($this->checkedProducts["$id"]);
    //         }
    //     }
    // }
}
