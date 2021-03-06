<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;

use App\Models\ProductVariant;
use App\Models\ProductStock;
use App\Models\Cart;
use App\Models\CartItem;

use Exception;

use Illuminate\Support\Facades\DB;

class CartsEdit extends Component
{
    public $cartItems = [
        [
            'id' => "",
            'size' => "",
            'surname' => "",
            'jersey_number' => "", 
        ]
    ];
    public $deleteExisting = [];
    public $cartVariant;
    public $sizes;
    public $totalAmount;

    protected $rules = [
        'cartItems.*.size' => 'required|string|in:2XS,XS,S,M,L,XL,2XL',
        'cartItems.*.surname' => 'required|string|regex:/^[a-zA-Z ]*$/|max:15',
        'cartItems.*.jersey_number' => 'required|integer|min:0|max:99|not_in:-0',
    ];

    protected $validationAttributes = [
        'cartItems.*.size' => 'jersey size',
        'cartItems.*.surname' => 'jersey surname',
        'cartItems.*.jersey_number' => 'jersey number',
    ];

    public function mount(Cart $id)
    {
        $this->cartId = $id;

        $this->cartVariant = ProductVariant::where('id', $this->cartId->product_variant_id)
                                ->first();

        $this->sizes = ProductStock::where('product_variant_id', $id->product_variant_id)->first();

        // dd($this->sizes);

        $this->productPrice = $this->cartVariant->product()->first()->prd_price;

        $this->cartItems = $id->cart_items()->get()->toArray();

        $this->totalAmount = $this->productPrice * count($this->cartItems);
    }

    public function render()
    {
        return view('livewire.shop.carts.carts-edit');
    }

    public function hydrate()
    {
        if(!empty($this->getErrorBag())) {
            $this->resetErrorBag();
        }
    }

    public function update()
    {
        $this->validate();

        $originalStocks = $this->sizes->sizes->toArray();

        $variantStocks = array_count_values(array_column($this->cartItems, 'size'));

        foreach($variantStocks as $size => $count) {
            $originalCountSize = $originalStocks[$size];

            if( $count > $originalCountSize ) {
                session()->flash('fail', 'The quantity of ' . $size . ' exceeded the available size!');
                return;
            }
        }

        try {
            DB::transaction(function() {
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

                if($newCartItems) {
                    $this->createItems($newCartItems);
                }

                // Delete existing cart items if there are any            
                if($this->deleteExisting) {
                    $this->deleteItems($this->deleteExisting);
                }

                $this->cartId->refresh();

                $this->emitUp('refreshParent');

                session()->flash('success', 'Cart has been successfully updated!');
            });
        } catch(Exception $error) {
            session()->flash('An error occured! ' . $error);
        }
    }

    public function createItems($newCartItems)
    {
        $this->cartId->cart_items()->createMany($newCartItems);

    }

    public function updateItems($origCartItems)
    {
        $origIds = $origCartItems->pluck('id');

        $updatedValues = $origCartItems->toArray();

        $origItems = CartItem::whereIn('id', $origIds)->get();

        foreach($origItems as $index => $origItem) {
            $origItem->update($updatedValues[$index]);
        }
    }

    public function deleteItems($deleteExistingItems)
    {
        $cartItems = CartItem::whereIn('id', $deleteExistingItems)->get();

        $cartItems->each->forceDelete();
    }

    public function addMore()
    {
        if (count($this->cartItems) === 10) {
            session()->flash('fail', 'Only 10 items are allowed!');
        } else {
            $this->cartItems[] = [
                'id' => null,
                'size' => "",
                'surname' => "",
                'jersey_number' => "",
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
        $this->deleteExisting = [];

        $this->dispatchBrowserEvent('cartEditModalDisplayNone');

        $this->emitUp('closeEditCartModal');
    }
}
