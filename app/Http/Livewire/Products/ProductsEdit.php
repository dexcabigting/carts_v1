<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
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

    protected $listeners = [
        'closeEdit',
    ];

    protected function rules()
    {
        return [
            'form.prd_name' => 'required|string|max:255|unique:products,prd_name' . $this->product->id,
            'form.prd_category' => 'required|string|max:255|exists:categories,id',
            'form.prd_fabric' => 'required|string|max:255|exists:fabrics,id',
            'form.prd_description' => 'required|string|max:255',
            'form.prd_price' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
            'addVariants.*.prd_var_name' => 'required|string|max:255|unique:product_variants,prd_var_name',
            'addVariants.*.front_view' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'addVariants.*.back_view' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'addVariants.*.2XS'  => 'required_without_all:addVariants.*.XS,addVariants.*.S,addVariants.*.M,addVariants.*.L,addVariants.*.XL,addVariants.*.2XL|integer|min:10|max:100',
            'addVariants.*.XS'  => 'required_without_all:addVariants.*.2XS,addVariants.*.S,addVariants.*.M,addVariants.*.L,addVariants.*.XL,addVariants.*.2XL|integer|min:10|max:100',
            'addVariants.*.S'  => 'required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.M,addVariants.*.L,addVariants.*.XL,addVariants.*.2XL|integer|min:10|max:100',
            'addVariants.*.M'  => 'required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.S,addVariants.*.L,addVariants.*.XL,addVariants.*.2XL|integer|min:10|max:100',
            'addVariants.*.L'  => 'required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.S,addVariants.*.M,addVariants.*.XL,addVariants.*.2XL|integer|min:10|max:100',
            'addVariants.*.XL'  => 'required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.S,addVariants.*.M,addVariants.*.L,addVariants.*.2XL|integer|min:10|max:100',
            'addVariants.*.2XL'  => 'required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.S,addVariants.*.M,addVariants.*.L,addVariants.*.XL|integer|min:10|max:100',
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
        $this->form['prd_description'] = $id->prd_description;
        $this->form['prd_price'] = $id->prd_price;

        $productStock = $id->product_stock;
        
        $this->form['xxsmall'] = $productStock->xxsmall;
        $this->form['xsmall'] = $productStock->xsmall;
        $this->form['small'] = $productStock->small;
        $this->form['medium'] = $productStock->medium;
        $this->form['large'] = $productStock->large;
        $this->form['xlarge'] = $productStock->xlarge;
        $this->form['xxlarge'] = $productStock->xxlarge;
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
