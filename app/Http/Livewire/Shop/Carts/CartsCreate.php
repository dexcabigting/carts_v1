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
    public $addItems = [
        [
            'size' => "",
            'surname' => "",
            'jersey_number' => "",
        ]
    ];
    public $totalAmount;
    public $productPrice;
    public $selectVariant;
    public $productVariantStocks;
    public $SIZES = [
        '2XS',
        'XS',
        'S',
        'M',
        'L',
        'XL',
        '2XL',
    ];

    protected $rules = [
        'addItems.*.size' => 'required|string|in:2XS,XS,S,M,L,XL,2XL',
        'addItems.*.surname' => 'required|string|regex:/^[a-zA-Z ]*$/|max:20',
        'addItems.*.jersey_number' => 'required|numeric|max:99',
    ];

    protected $validationAttributes = [
        'addItems.*.size' => 'jersey size',
        'addItems.*.surname' => 'jersey surname',
        'addItems.*.jersey_number' => 'jersey number',
    ];

    public function mount(Product $id)
    {
        $sizes = $this->SIZES;

        $this->product = $id->load(['category','fabric']);

        $this->productVariants = ProductVariant::where('product_id', $this->product->id)
                                ->whereDoesntHave('product_stock', function ($query) use($sizes) {
                                    foreach($sizes as $size) {
                                        $query->where($size, '=', 0);
                                    }
                                })
                                ->select('id','prd_var_name')->get();    

        $this->selectVariant = $this->productVariants[0]['id'];

        $this->category = $this->product->category->ctgr_name;

        $this->productPrice =  $this->product->prd_price;

        $this->totalAmount  = $this->totalAmount + $this->productPrice;
    }

    public function render()
    {
        $stocks = $this->variant_stocks->first();

        $variant = $this->variant->first();

        $variants = $this->variants->paginate(1);                                                                  

        return view('livewire.shop.carts.carts-create', compact('stocks', 'variant', 'variants'));
    }

    public function hydrate()
    {
        if(!empty($this->getErrorBag())) {
            $this->resetErrorBag();
        }
    }

    public function getQueryString()
    {
        return [];
    }

    public function getVariantProperty()
    {
        return ProductVariant::where('id', $this->selectVariant);
    }

    public function getVariantsProperty()
    {
        $sizes = $this->SIZES;

        return ProductVariant::where('product_id', $this->product->id)
                    ->whereDoesntHave('product_stock', function ($query) use($sizes) {
                                    foreach($sizes as $size) {
                                        $query->where($size, '=', 0);
                                    }
                                });
    }

    public function getVariantStocksProperty()
    {
        return ProductStock::where('product_variant_id', $this->selectVariant);
    }

    public function store()
    {
        // TO DO: set $this->addItems limit with a maximum value of 15
        $this->validate();

        $productVariant = ProductVariant::where('id', $this->selectVariant)->first(); 

        $productVariantId = $productVariant->id;

        //Sizes to be inserted in the database
        $variantStocks = array_count_values(array_column($this->addItems, 'size'));

        $originalStocks = $this->variant_stocks->first()->sizes->toArray();

        foreach($variantStocks as $size => $count) {
            $originalCountSize = $originalStocks[$size];

            if( $count > $originalCountSize ) {
                session()->flash('fail', 'The quantity of ' . $size . ' exceeded the available size!');
                return;
            }
        }

        // Check if the variant is already on the user's cart
        if ($productVariant->userHasVariantInCart()) {
            // dd("You already have this on your cart");

            $userCart = auth()->user()->carts()->where('product_variant_id', $productVariantId)->first();

            $existingVariantInCartSizes = $userCart->cart_items()->pluck('size')->countBy();

            $stocks = collect($variantStocks)->map( function ($item, $size) use($existingVariantInCartSizes) {
                if(isset($existingVariantInCartSizes[$size])) {
                    return $item + $existingVariantInCartSizes[$size];
                }
                return $item;
            })->toArray();

            foreach ($stocks as $size => $count) {
                $originalCountSize = $originalStocks[$size];

                if ($count > $originalCountSize) {
                    session()->flash('fail', 'The quantity of ' . $size . ' exceeded the available size!');
                    return;
                }
            }

            $userCart->cart_items()->createMany($this->addItems);

            $flash = "Your existing cart has been updated!";
        } else {
            // If user doesn't have this variant on his/her cart

            $cart = Cart::create([
                'user_id' => auth()->id(),
                'product_variant_id' => $productVariantId,
            ]);

            $cart->cart_items()->createMany($this->addItems);

            $flash = "Cart has been created successfully!";
        }

        $this->reset(['addItems']);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   

        $this->totalAmount  = $this->productPrice;

        session()->flash('success', $flash); 
    }

    public function addMore()
    {
        if(count($this->addItems) === 10) {
            session()->flash('fail', 'Only 10 items are allowed!');
        } else {
            $this->addItems[] = [
                'size' => "",
                'surname' => "",
                'jersey_number' => "",
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
        $this->reset(['addItems']);

        $this->dispatchBrowserEvent('cartModalDisplayNone');

        $this->emitUp('closeCartModal');
    }

    
}
