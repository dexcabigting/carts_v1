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
        'addItems.*.size' => 'required|string',
        'addItems.*.surname' => 'required|string',
        'addItems.*.jersey_number' => 'required|numeric|min:1|max:99',
    ];

    protected $validationAttributes = [
        'addItems.*.size' => 'Jersey Size',
        'addItems.*.surname' => 'Jersey Surname',
        'addItems.*.jersey_number' => 'Jersey Number',
    ];

    public function mount(Product $id)
    {
        $this->product = $id->load(['category','fabric']);

        $this->productVariants = ProductVariant::where('product_id', $this->product->id)->select('id','prd_var_name')->get();    

        $this->selectVariant = $this->productVariants[0]['id'];

        $this->category = $this->product->category->ctgr_name;
        
        if($this->category == 'Jersey') {
            $count = 10;
        } else {
            $count = 1;
        }

        $this->addItems = [];

        $this->productPrice =  $this->product->prd_price;

        for ($i = 1; $i <= $count; $i++) {
            $item = [
                'size' => '',
                'surname' => '',
                'jersey_number' => '',
            ];

            array_push($this->addItems, $item);

            $this->totalAmount  = $this->totalAmount + $this->productPrice;
        }
    }

    public function render()
    {
        $stocks = $this->variant_stocks->first();

        $variant = $this->variant->first();

        $variants = $this->variants->paginate(1);                                                                  

        return view('livewire.shop.carts.carts-create', compact('stocks', 'variant', 'variants'));
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
        return ProductVariant::where('product_id', $this->product->id);
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

            // $test = array_merge_recursive($existingVariantInCartSizes, $variantStocks);

            // foreach($test as $array) {
            //     if(is_array($array)) {
            //         $array = array_sum($array);
            //     }
            // }

            $stocks = $existingVariantInCartSizes->each( function ($item) use($variantStocks) {
                return array_push($variantStocks, $item);
            });
            
                
            dd($existingVariantInCartSizes, $stocks, $variantStocks);

            $userCart->cart_items()->createMany($this->addItems);

            $flash = "Your existing cart has been updated!";
        } else {
            // dd("You don't have this on your cart yet");

            $cart = Cart::create([
                'user_id' => auth()->id(),
                'product_variant_id' => $productVariantId,
            ]);

            $cart->cart_items()->createMany($this->addItems);

            $flash = "Cart has been created successfully!";
        }

        $this->addItems = [
            [
                'size' => '',
                'surname' => '',
                'jersey_number' => '',
            ]
        ];                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           

        $this->totalAmount  = $this->productPrice;

        session()->flash('success', $flash); 
    }

    public function addMore()
    {
        if(count($this->addItems) === 15) {
            session()->flash('fail', 'Only 15 items are allowed!');
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
        if(($this->category == 'Jersey') && (count($this->addItems) === 10)) {
            session()->flash('fail', 'The jersey quantity should not subceed 10');
        } else {
            unset($this->addItems[$index]);

            $this->addItems = array_values($this->addItems);

            $this->totalAmount = $this->totalAmount - $this->productPrice;
        }
    }

    public function closeCartModal()
    {
        $this->addItems = [
            [
                'size' => '',
                'surname' => '',
                'jersey_number' => '',
            ]
        ];

        $this->dispatchBrowserEvent('cartModalDisplayNone');

        $this->emitUp('closeCartModal');
    }

    
}
