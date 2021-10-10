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

        $productVariants = ProductVariant::with('product_stock')
            ->where('product_id', $this->product->id)->get();

        $this->addVariants = [];

        foreach($productVariants as $productVariant) {
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

        $imagePath = pathinfo($this->product->prd_image);

        $newProductImagePath = $imagePath['dirname'] . '/' . $this->form['prd_name'] . Str::random(30) . '.' . $imagePath['extension'];
        
        if($this->form['prd_name'] != $this->product->prd_name) {
            // If admin changes the product name, product image name should be updated

            Storage::move('public/' . $this->product->prd_image, 'public/' . $newProductImagePath);
        } elseif($this->form['prd_image']) {
            // If admin changes the product image, old image must be removed and replaced with a renamed image according to product name
            Storage::delete('public/' . $this->product->prd_image);

            $prdImage = $this->form['prd_image'];

            $newProductImageName = $this->form['prd_name'] . Str::random(30) . '.' . $prdImage->extension();

            $newProductImagePath = $prdImage->storeAs('/images/products', $newProductImageName,'public');

        }
        
    
        $this->product->update([
            'prd_name' => $this->form['prd_name'],
            'prd_description' => $this->form['prd_description'],
            'prd_price' => $this->form['prd_price'],
        ]);

        $productStocks = [
            'xxsmall' => $this->form['xxsmall'],
            'xsmall' => $this->form['xsmall'],
            'small' => $this->form['small'],
            'medium' => $this->form['medium'],
            'large' => $this->form['large'],
            'xlarge' => $this->form['xlarge'],
            'xxlarge' => $this->form['xxlarge'],
        ];

        $this->product->product_stock->update($productStocks);

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been updated successfully!');
    }

    public function closeEditModal()
    {
        $this->resetValidation();

        $this->dispatchBrowserEvent('editModalDisplayNone');
        
        $this->emitUp('closeEditModal');
    }
}
