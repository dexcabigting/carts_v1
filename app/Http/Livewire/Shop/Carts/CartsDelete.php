<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\Cart;

class CartsDelete extends Component
{
    public $carts = [];

    public $promptDelete = 1;
    public $promptDeleted = 0;

    public function mount(...$id)
    {
        $this->carts = collect($id)->flatten()->toArray();
        dd($this->carts);
    }

    public function render()
    {
        return view('livewire.shop.carts.carts-delete');
    }

    public function deleteCarts()
    {
        if (count($this->carts) == 1) {
            $flash = 'Cart has been deleted successfully!';
        } else {
            $flash = 'Carts have been deleted successfully!';
        }

        Cart::whereIn('id', $this->carts)->delete();

        $this->emitUp('unsetCheckedCarts', $this->carts);

        $this->emitUp('cleanse');

        $this->emitUp('refreshParent');

        session()->flash('success', $flash);

        $this->carts = [];

        $this->promptDelete = 0;
        $this->promptDeleted = 1;
    }

    public function closeDeleteCartModal()
    {
        $this->dispatchBrowserEvent('cartDeleteModalDisplayNone');
        $this->emitUp('closeDeleteCartModal');
    }
}
