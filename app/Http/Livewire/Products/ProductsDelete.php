<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductsDelete extends Component
{
    public $products = [];

    public $promptDelete = 1;
    public $promptDeleted = 0;

    public function mount(...$id)
    {
        $this->products = collect($id)->flatten()->toArray();
    }

    public function render()
    {
        return view('livewire.products.products-delete');
    }

    public function deleteProducts()
    {
        if (count($this->products) == 1) {
            $flash = 'Product has been deleted successfully!';
        } else {
            $flash = 'Products have been deleted successfully!';
        }
            
        Product::whereIn('id', $this->products)->delete();

        $this->emitUp('unsetCheckedProducts', $this->products);

        $this->emitUp('cleanse');

        $this->emitUp('refreshParent');

        session()->flash('success', $flash);

        $this->products = [];

        $this->promptDelete = 0;
        $this->promptDeleted = 1;
    }

    public function closeDeleteModal()
    {
        $this->dispatchBrowserEvent('deleteModalDisplayNone');
        $this->emitUp('closeDeleteModal');
    }
}
