<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductsDelete extends Component
{
    public $products = [];

    public $promptDelete = 1;
    public $promptDeleted = 0;

    public function mount(Product $id)
    {
        $this->products = $id;
    }

    public function render()
    {
        return view('livewire.products.products-delete');
    }

    public function deleteProducts()
    {

        Product::whereIn('id', $this->products)->delete();

        // $this->emitUp('unsetCheckedProducts', $this->products);

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been deleted successfully!');

        $this->products = null;

        $this->promptDelete = 0;
        $this->promptDeleted = 1;
    }

    public function closeDeleteModal()
    {
        $this->dispatchBrowserEvent('deleteModalDisplayNone');
        $this->emitUp('closeDeleteModal');
    }
}
