<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cart;

class CartsIndex extends Component
{
    use WithPagination;

    public $checkedCarts;
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
        $this->cartId = [];
    }

    public function render()
    {
        $userCarts = $this->user_carts->paginate(6);

        return view('livewire.shop.carts.carts-index', compact('userCarts'));
    }

    public function getUserCartsProperty()
    {
        return auth()->user()->carts()->with(['product_variant.product'])
            ->withCount('cart_items');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checkedCarts = Cart::where('user_id', auth()->id())
                ->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->flip()
                ->map(fn ($item) => true)
                ->toArray();
        } else {
            $this->checkedCarts = [];
        }
    }

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
