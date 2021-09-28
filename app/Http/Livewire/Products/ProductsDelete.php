<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductsDelete extends Component
{
    public $product;

    public $promptDelete = 1;
    public $promptDeleted = 0;

    protected $listeners = [
        'deleteProductId' => 'getProductId',
    ];

    public function render()
    {
        return view('livewire.products.products-delete');
    }

    public function getProductId($id)
    {
        $this->product = $id;
    }

    public function deleteProduct()
    {
        Product::where('id', $this->product)->delete();

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been deleted successfully!');

        $this->promptDelete = 0;
        $this->promptDeleted = 1;
    }

    public function deleteChecked()
    {
        Product::where('id', $this->product)->delete();

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been deleted successfully!');

        $this->promptDelete = 0;
        $this->promptDeleted = 1;
    }

    public function closeDeleteModal()
    {
        $this->dispatchBrowserEvent('deleteModalDisplayNone');
        $this->emitUp('closeDeleteModal');
    }
}
