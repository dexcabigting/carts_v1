<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Cart;
use App\Models\ProductStock;

class CartsIndex extends Component
{
    use WithPagination;

    public $checkedCarts;
    public $removedKeys;
    public $withStocks;
    public $cartId;
    public $cartEditModal = false;
    public $cartDeleteModal = false;
    public $selectAll = false;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeEditCartModal',
        'closeDeleteCartModal',
        'cleanse',
        'unsetCheckedCarts',
    ];

    public function mount()
    {
        $this->checkedCarts = [];
        $this->removedKeys = [];
        $this->withStocks = [];
        $this->cartId = [];
    }

    public function render()
    {
        $userCarts = $this->user_carts->paginate(6);

        return view('livewire.shop.carts.carts-index', compact('userCarts'))->layout('layouts.app-user');
    }

    public function getUserCartsProperty()
    {
        return auth()->user()->carts()->with(['product_variant.product'])
            ->withCount('cart_items');
    }

    public function outOfStock(Cart $id): bool
    {
        $sizes = ProductStock::where('product_variant_id', $id->product_variant_id)->first();

        $cartItems = $id->cart_items()->get()->toArray();

        $originalStocks = $sizes->sizes->toArray();

        $variantStocks = array_count_values(array_column($cartItems, 'size'));

        foreach($variantStocks as $size => $count) {
            $originalCountSize = $originalStocks[$size];

            if($originalCountSize == 0) {
                return true;
            }
        }

        return false;
    }

    public function updatedSelectAll($value)
    {
        if($value) {
            $this->checkedCarts = Cart::where('user_id', auth()->id())
                ->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->flip()
                ->map(fn ($item) => true)
                ->toArray();

            foreach($this->checked_keys as $checked_key) {
                $checkedCart = Cart::findOrFail($checked_key);
                if($this->outOfStock($checkedCart)) {
                    array_push($this->removedKeys, $checked_key);
                    unset($this->checkedCarts[$checked_key]);    
                } 
            }

            $this->withStocks = array_values(array_diff($this->checked_keys, $this->removedKeys));
        } else {
            $this->checkedCarts = [];
        }
    }

    public function getCheckedKeysProperty()
    {
        return array_keys($this->checkedCarts);
    }

    // public function getWithStockKeysProperty()
    // {
    //     $arr = $this->checked_keys;
    //     foreach($this->removedKeys as $remove){
    //         unset($arr[$remove]);
    //     }

    //     return $arr;
    // }

    public function updatedCheckedCarts()
    {
        $this->selectAll = false;

        $this->checkedCarts = array_filter($this->checkedCarts);
    }

    public function openEditCartModal($id)
    {
        $this->cartId = $id;

        $this->cartEditModal = true;
    }

    public function openDeleteCartModal($id)
    {
        $this->cartId = $id;

        $this->cartDeleteModal = true;
    }

    public function closeEditCartModal()
    {
        $this->cartEditModal = false;
    }

    public function closeDeleteCartModal()
    {
        $this->cartDeleteModal = false;
    }

    public function cleanse()
    {
        $this->checkedCarts = [];

        $this->selectAll = false;
    }

    public function unsetCheckedCarts($ids)
    {
        if (is_array($this->checkedCarts)) {
            foreach ($ids as $id) {
                unset($this->checkedCarts['$id']);
            }
        }
    }
}
