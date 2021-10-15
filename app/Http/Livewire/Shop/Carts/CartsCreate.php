<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductStock;
use App\Models\Cart;
use Livewire\WithPagination;

class CartsCreate extends Component
{
    use WithPagination;

    public $product;
    public $addItems;
    public $totalAmount;
    public $productPrice;
    public $selectVariant;
    public $productVariantStocks;

    protected $rules = [
        'addItems.*.size' => 'required|string',
        'addItems.*.surname' => 'required|string',
        'addItems.*.jersey_number' => 'required|numeric|min:1|max:99',
    ];

    protected $validationAttributes = [
        'addItems.*.size' => '*Jersey Size',
        'addItems.*.surname' => 'Jersey Surname',
        'addItems.*.jersey_number' => 'Jersey Number',
    ];

    public function mount(Product $id)
    {
        $this->product = $id;

        $this->productVariants = ProductVariant::where('product_id', $this->product->id)->select('id','prd_var_name')->get()->toArray();    

        $this->selectVariant = $this->productVariants[0]['id'];
        
        $this->addItems = [
            [
                'size' => '',
                'surname' => '',
                'jersey_number' => '',
            ]
        ];

        $this->productPrice =  $this->product->prd_price;

        $this->totalAmount  = $this->productPrice;
    }

    public function render()
    {
        $sizes = $this->variant_stocks->first();

        $variant = $this->product_variant->first();

        $variants = $this->product_variants->paginate(1);                                                                  

        return view('livewire.shop.carts.carts-create', compact('sizes', 'variant', 'variants'));
    }

    // public function getProductVariantsProperty()
    // {
    //     return ProductVariants::where('product_id', $this->product->id);
    // }

    public function getProductVariantProperty()
    {
        return ProductVariant::where('id', $this->selectVariant);
    }

    public function getProductVariantsProperty()
    {
        return ProductVariant::where('product_id', $this->product->id);
    }

    public function getVariantStocksProperty()
    {
        return ProductStock::where('product_variant_id', $this->selectVariant);
    }

    public function store()
    {
        $this->validate();

        $quantity = count($this->addItems);

        $productVariantId = $this->selectVariant;

        $cart = Cart::create([
            'user_id' => auth()->id(),
            'product_variant_id' => $productVariantId,
            'quantity' => $quantity,
            'subtotal' => $quantity * $this->product->prd_price,
        ]);

        $cart->cart_items()->createMany($this->addItems);

        $this->addItems = [
            [
                'size' => '',
                'surname' => '',
                'jersey_num' => '',
            ]
        ];                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           

        $this->totalAmount  = $this->productPrice;

        session()->flash('success', 'Cart has been created successfully!'); 
    }

    public function addMore()
    {
        if(count($this->addItems) === 5) {
            session()->flash('fail', 'Only 5 variants are allowed!');
        } else {
            $this->addItems[] = [
                'size' => '',
                'surname' => '',
                'jersey_number' => '',
            ];

            $this->totalAmount = $this->totalAmount + $this->productPrice;
        }
    }

    public function removeItem($index)
    {
        unset($this->addItems[$index]);

        $this->addItems = array_values($this->addItems);

        $this->totalAmount = $this->totalAmount - $this->productPrice;
    }

    public function closeCartModal()
    {
        $this->addItems = [
            [
                'size' => '',
                'surname' => '',
                'jersey_num' => '',
            ]
        ];

        $this->dispatchBrowserEvent('cartModalDisplayNone');

        $this->emitUp('closeCartModal');
    }

    
}
