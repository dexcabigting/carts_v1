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

    public $prd_image;

     /**
     * @var ['prd_image'] mixed
     */
    public $form = [
        'prd_name' => '',
        'prd_description' => '',
        'prd_price' => '',
        'prd_image' => null,
        'xxsmall'  => '',
        'xsmall'  => '',
        'small'  => '',
        'medium'  => '',
        'large'  => '',
        'xlarge'  => '',
        'xxlarge'  => '',
    ];

    protected $listeners = [
        'editProductId' => 'getProductId',
        'closeEdit',
    ];

    protected function rules()
    {
        return [
            'form.prd_name' => 'required|string|max:255|unique:products,prd_name,' . $this->product->id,
            'form.prd_description' => 'required|string|max:255',
            'form.prd_price' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
            'form.prd_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'form.xxsmall'  => 'required_without_all:form.xsmall,form.small,form.medium,form.large,form.xlarge,form.xxlarge|integer|max:100',
            'form.xsmall'  => 'required_without_all:form.xxsmall,form.small,form.medium,form.large,form.xlarge,form.xxlarge|integer|max:100',
            'form.small'  => 'required_without_all:form.xxsmall,form.xsmall,form.medium,form.large,form.xlarge,form.xxlarge|integer|max:100',
            'form.medium'  => 'required_without_all:form.xxsmall,form.xsmall,form.small,form.large,form.xlarge,form.xxlarge|integer|max:100',
            'form.large'  => 'required_without_all:form.xxsmall,form.xsmall,form.small,form.medium,form.xlarge,form.xxlarge|integer|max:100',
            'form.xlarge'  => 'required_without_all:form.xxsmall,form.xsmall,form.small,form.medium,form.large,form.xxlarge|integer|max:100',
            'form.xxlarge'  => 'required_without_all:form.xxsmall,form.xsmall,form.small,form.medium,form.large,form.xlarge|integer|max:100',
        ];
    }

    protected $validationAttributes = [
        'form.prd_name' => 'product name',
        'form.prd_description' => 'product description',
        'form.prd_price' => 'product price',
        'form.prd_image' => 'product image',
        'form.xxsmall'  => 'xxsmall size',
        'form.xsmall'  => 'xsmall size',
        'form.small'  => 'small size',
        'form.medium'  => 'medium size',
        'form.large'  => 'large size',
        'form.xlarge'  => 'xlarge size',
        'form.xxlarge'  => 'xxlarge size',
    ];
    
    public function mount(Product $uid)
    {
        $this->product = $uid;

        $this->form['prd_name'] = $uid->prd_name;
        $this->form['prd_description'] = $uid->prd_description;
        $this->form['prd_price'] = $uid->prd_price;

        $productStock = $uid->product_stock;
        
        $this->form['xxsmall'] = $productStock->xxsmall;
        $this->form['xsmall'] = $productStock->xsmall;
        $this->form['small'] = $productStock->small;
        $this->form['medium'] = $productStock->medium;
        $this->form['large'] = $productStock->large;
        $this->form['xlarge'] = $productStock->xlarge;
        $this->form['xxlarge'] = $productStock->xxlarge;

        $this->prd_image = $uid->prd_image;
    }

    public function render()
    {
        return view('livewire.products.products-edit');
    }

    // public function getProductId(Product $id)
    // {
    //     $this->form['prd_name'] = $id->prd_name;
    //     $this->form['prd_description'] = $id->prd_description;
    //     $this->form['prd_price'] = $id->prd_price;

    //     $productStock = $id->product_stock;
        
    //     $this->form['xxsmall'] = $productStock->xxsmall;
    //     $this->form['xsmall'] = $productStock->xsmall;
    //     $this->form['small'] = $productStock->small;
    //     $this->form['medium'] = $productStock->medium;
    //     $this->form['large'] = $productStock->large;
    //     $this->form['xlarge'] = $productStock->xlarge;
    //     $this->form['xxlarge'] = $productStock->xxlarge;

    //     $this->mount($id);

    //     $this->prd_image = $id->prd_image;
    // }

    public function update()
    {
        $this->validate();

        $path = pathinfo($this->product->prd_image);

        $newProductImagePath = $path['dirname'] . '/' . $this->form['prd_name'] . Str::random(30) . '.' . $path['extension'];
        
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
            'prd_image' => $newProductImagePath,
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
