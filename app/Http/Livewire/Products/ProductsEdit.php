<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Fabric;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsEdit extends Component
{
   
    use WithFileUploads;

    public $product;
    
     /**
     * @var ['prd_image'] mixed
     */
    public $form = [
        'prd_name' => '',
        'prd_category' => '',
        'prd_fabric' => '',
        'prd_description' => '',
        'prd_price' => '',
    ];

    public $addVariants;
    public $categories = [];
    public $fabrics = [];
    public $productVariants = [];

    protected $listeners = [
        'closeEdit',
    ];

    protected function rules()
    {
        return [
            'form.prd_name' => 'required|string|max:100|unique:products,prd_name',
            'form.prd_category' => 'required|string|max:100|exists:categories,id',
            'form.prd_fabric' => 'required|string|max:100|exists:fabrics,id',
            'form.prd_description' => 'required|string|max:100',
            'form.prd_price' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
            'addVariants.*.prd_var_name' => 'required|string|max:100',
            'addVariants.*.front_view' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'addVariants.*.back_view' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'addVariants.*.2XS'  => 'nullable|integer|min:10|max:100',
            'addVariants.*.XS'  => 'nullable|integer|min:10|max:100',
            'addVariants.*.S'  => 'nullable|integer|min:10|max:100',
            'addVariants.*.M'  => 'nullable|integer|min:10|max:100',
            'addVariants.*.L'  => 'nullable|integer|min:10|max:100',
            'addVariants.*.XL'  => 'nullable|integer|min:10|max:100',
            'addVariants.*.2XL'  => 'nullable|integer|min:10|max:100',
        ];
    }

    protected $validationAttributes = [
        'form.prd_name' => 'product name',
        'form.prd_description' => 'product description',
        'form.prd_price' => 'product price',
        'form.prd_category' => 'product category',
        'form.prd_fabric' => 'product fabric',
        'addVariants.*.prd_var_name' => 'variant name',
        'addVariants.*.front_view' => 'front view image',
        'addVariants.*.back_view' => 'back view image',
        'addVariants.*.2XS'  => '2XS',
        'addVariants.*.XS'  => 'XS',
        'addVariants.*.S'  => 'S',
        'addVariants.*.M'  => 'M',
        'addVariants.*.L'  => 'L',
        'addVariants.*.XL'  => 'XL',
        'addVariants.*.2XL'  => '2XL',
    ];
    
    public function mount(Product $id)
    {
        $this->product = $id;

        $this->form['prd_name'] = $id->prd_name;
        $this->form['prd_category'] = $id->category_id;
        $this->form['prd_fabric'] = $id->fabric_id;
        $this->form['prd_description'] = $id->prd_description;
        $this->form['prd_price'] = $id->prd_price;

        $this->productVariants = ProductVariant::with('product_stock')
            ->where('product_id', $this->product->id)->get();

        $this->addVariants = [];

        foreach($this->productVariants as $productVariant) {
            $array = [
                'prd_var_name' => $productVariant->prd_var_name,
                'front_view' => null,
                'back_view' => null,
                '2XS' => $productVariant->product_stock->{'2XS'},
                'XS' => $productVariant->product_stock->XS,
                'S' => $productVariant->product_stock->S,
                'M' => $productVariant->product_stock->M,
                'L' => $productVariant->product_stock->L,
                'XL' => $productVariant->product_stock->XL,
                '2XL' => $productVariant->product_stock->{'2XL'},
            ];

            array_push($this->addVariants, $array);
        }
        
        $this->categories = Category::all();

        $this->fabrics = Fabric::all();
    }

    public function render()
    {
        return view('livewire.products.products-edit');
    }

    public function update()
    {
        $this->validate();

        $count = count($this->addVariants);
    
        $this->product->update([
            'prd_name' => $this->form['prd_name'],
            'category_id' => $this->form['prd_category'],
            'fabric_id' => $this->form['prd_fabric'],
            'prd_description' => $this->form['prd_description'],
            'prd_price' => $this->form['prd_price'],
        ]);

        // $productVariants = $this->product->product_variants()->createMany($productVariants);

        for($i = 0; $i < $count; $i++) {
            $variant = ProductVariant::where('prd_var_name', $this->addVariants[$i]['prd_var_name'])->find();

            $productVariantsStocks = [
                '2XS' => $this->addVariants[$i]['2XS'],
                'XS' => $this->addVariants[$i]['XS'],
                'S' => $this->addVariants[$i]['S'],
                'M' => $this->addVariants[$i]['M'],
                'L' => $this->addVariants[$i]['L'],
                'XL' => $this->addVariants[$i]['XL'],
                '2XL' => $this->addVariants[$i]['2XL'],
            ];

            // If variant does not exist
            if(!$variant) {

                $variantFront = $this->addVariants[$i]['front_view'];
                $variantBack = $this->addVariants[$i]['back_view'];

                $newFrontName = $this->addVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $variantFront->extension();
                $newBackName = $this->addVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $variantBack->extension();
        
                $frontImagePath = $variantFront->storeAs('/images/products', $newFrontName,'public');
                $backImagePath = $variantBack->storeAs('/images/products', $newBackName,'public');

                $newVariant = ProductVariant::create([
                    'prd_var_name' => $this->addVariants[$i]['prd_var_name'],
                    'front_view' => $frontImagePath,
                    'back_view' => $backImagePath,
                ]);

                $newVariant->product_stock()->create($productVariantsStocks);

            } else {
                // If variant exists
                foreach($this->productVariants as $productVariant) {
              
                }
            }
        }

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been updated successfully!');
    }

    public function addMore()
    {
        if(count($this->addVariants) == 5) {
            session()->flash('fail', 'Only 5 variants are allowed!'); 
        } else {
            $this->addVariants[] = [
                'prd_var_name' => '',
                'front_view' => null,
                'back_view' => null,
                '2XS'  => '',
                'XS'  => '',
                'S'  => '',
                'M'  => '',
                'L'  => '',
                'XL'  => '',
                '2XL'  => '',
            ];
        }
    }

    public function removeVariant($index)
    {
        unset($this->addVariants[$index]);

        $this->addVariants = array_values($this->addVariants);
    }

    public function closeEditModal()
    {
        $this->resetValidation();

        $this->dispatchBrowserEvent('editModalDisplayNone');
        
        $this->emitUp('closeEditModal');
    }
}
