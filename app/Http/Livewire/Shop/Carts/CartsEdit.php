<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\ProductVariant;
use App\Models\Cart;
use App\Models\CartItem;

class CartsEdit extends Component
{
    public $cartItems = [
        [
            'id' => '',
            'size' => '',
            'surname' => '',
            'jersey_number' => '', 
        ]
    ];
    public $deleteExisting = [];
    public $cartVariant;
    public $totalAmount;

    public function mount(Cart $id)
    {
        $this->cartId = $id;

        $this->cartVariant = ProductVariant::where('id', $this->cartId->product_variant_id)->first();

        $this->productPrice = $this->cartVariant->product()->first()->prd_price;

        $this->totalAmount = $id->subtotal;

        $this->cartItems = $id->cart_items()->get()->toArray();
    }

    public function render()
    {
        // dd($this->cartItems);
        return view('livewire.shop.carts.carts-edit');
    }

    public function update()
    {
        // Update existing cart items
        $origCartItems = collect($this->cartItems)
            ->filter(fn ($value) => $value['id'] != null);

        if($origCartItems) {
            $this->updateItems($origCartItems);
        }

        // Create new cart items
        $newCartItems = collect($this->cartItems)
            ->filter(fn ($value) => $value['id'] == null)
            ->map(fn ($value) => array_filter($value));

        //$cart = $this->cartId->cart_items()->createMany();

        // Delete existing cart items if there are any
        $deleteExistingItems = $this->deleteExisting;
        
        if($deleteExistingItems) {
            //$this->deleteItems($deleteExistingItems);
        }

        $this->emitUp('refreshParent');

        session()->flash('success', 'Cart has been updated successfully!');

        // dd($origCartItems, $newCartItems, $deleteExistingItems);
    }

    private function updateItems($origCartItems)
    {
        $origIds = $origCartItems->pluck('id');

        // $updatedValues = $origCartItems->map(function ($value) {
        //     unset($value['id']);
        //     return $value;
        // })->toArray();

        $updatedValues = $origCartItems->toArray();

        $origItems = CartItem::whereIn('id', $origIds)->get();

        foreach($origItems as $index => $origItem) {
            $origItem->update($updatedValues[$index]);
        }
    }

    // private function deleteItems($deleteExistingItems)
    // {
    //     $items = CartItem::whereIn('id', $deleteExistingItems)->get();

    //     if($items) {
    //         CartItem::destroy($items);
    //     }
    // }

    public function addMore()
    {
        if (count($this->cartItems) == 5) {
            session()->flash('fail', 'Only 5 variants are allowed!');
        } else {
            $this->cartItems[] = [
                'id' => null,
                'size' => '',
                'surname' => '',
                'jersey_number' => '',
            ];

            $this->totalAmount = $this->totalAmount + $this->productPrice;
        }
    }

    public function removeCartItem($index)
    {
        $id = $this->cartItems[$index]['id'];

        if ($id !== NULL) {
            array_push($this->deleteExisting, $id);
        }

        unset($this->cartItems[$index]);

        $this->cartItems = array_values($this->cartItems);

        $this->totalAmount = $this->totalAmount - $this->productPrice;
    }

    public function closeCartModal()
    {
        $this->dispatchBrowserEvent('cartModalDisplayNone');

        $this->emitUp('closeEditCartModal');
    }
}
