<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class CartsIndex extends Component
{
    use WithPagination;

    public $cartId;
    public $cartModal = false;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeEditCartModal',
    ];

    public function mount()
    {
        
    }

    public function render()
    {
        $userCarts = $this->user_carts->paginate(6);

        return view('livewire.shop.carts.carts-index', compact('userCarts'));
    }

    public function getUserCartsProperty()
    {
        return auth()->user()->carts()->with(['product_variant.product']);
    }

    public function getTotalAmountProperty()
    {
        // return $this->user_carts->sum('subtotal');
    }

    public function openEditCartModal($id)
    {
        $this->cartId = $id;

        $this->cartModal = true;
    }

    public function openDeleteCartModal($id)
    {
        $this->cartId = $id;
    }

    public function closeEditCartModal()
    {
        $this->cartModal = false;
    }
}
