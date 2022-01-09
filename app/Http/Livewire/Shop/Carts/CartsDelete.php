<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;

use App\Models\Cart;

use Exception;

use Illuminate\Support\Facades\DB;

class CartsDelete extends Component
{
    public $carts = [];

    public $promptDelete = 1;
    public $promptDeleted = 0;

    public function mount(...$id)
    {
        $this->carts = collect($id)->flatten()->toArray();
    }

    public function render()
    {
        return view('livewire.shop.carts.carts-delete');
    }

    public function deleteCarts()
    {
        if (count($this->carts) == 1) {
            $flash = 'Cart has been successfully deleted!';
        } else {
            $flash = 'Carts have been successfully deleted!';
        }

        try {
            DB::transaction(function() use($flash) {
                Cart::whereIn('id', $this->carts)->delete();

                $this->emitUp('unsetCheckedCarts', $this->carts);

                $this->emitUp('cleanse');

                $this->emitUp('refreshParent');

                session()->flash('success', $flash);

                $this->carts = [];

                $this->promptDelete = 0;
                $this->promptDeleted = 1;
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function closeDeleteCartModal()
    {
        $this->dispatchBrowserEvent('cartDeleteModalDisplayNone');
        $this->emitUp('closeDeleteCartModal');
    }
}
