<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

use App\Models\Product;

use Exception;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            $flash = 'Product has been successfully deleted!';
        } else {
            $flash = 'Products have been successfully deleted!';
        }
            
        $products = Product::whereIn('id', $this->products)->get();

        $products->each(function ($product) {
                    $variants = $product->product_variants()->get();

                    $variants->each(function ($variant) {
                        Storage::disk('root')->delete('app/public/' . $variant->front_view);
                        Storage::disk('root')->delete('app/public/' . $variant->back_view);
                    });
                })
                ->each
                ->delete();

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
