<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductsCreate extends Component
{
    /**
     * @var ['prd_image'] mixed
     */
    use WithFileUploads;

    public $form = [
        'prd_name' => '',
        'prd_description' => '',
        'prd_price' => '',
        'prd_image' => null,
        'prd_3d' => null,
        'xxsmall'  => '',
        'xsmall'  => '',
        'small'  => '',
        'medium'  => '',
        'large'  => '',
        'xlarge'  => '',
        'xxlarge'  => '',
    ];

    protected function rules()
    {
        return [
            'form.prd_name' => 'required|string|max:255|unique:products,prd_name',
            'form.prd_description' => 'required|string|max:255',
            'form.prd_price' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
            'form.prd_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'form.prd_3d' => 'required|file',
            'form.xxsmall'  => 'required_without_all:form.xsmall,form.small,form.medium,form.large,form.xlarge,form.xxlarge|integer|min:10|max:100',
            'form.xsmall'  => 'required_without_all:form.xxsmall,form.small,form.medium,form.large,form.xlarge,form.xxlarge|integer|min:10|max:100',
            'form.small'  => 'required_without_all:form.xxsmall,form.xsmall,form.medium,form.large,form.xlarge,form.xxlarge|integer|min:10|max:100',
            'form.medium'  => 'required_without_all:form.xxsmall,form.xsmall,form.small,form.large,form.xlarge,form.xxlarge|integer|min:10|max:100',
            'form.large'  => 'required_without_all:form.xxsmall,form.xsmall,form.small,form.medium,form.xlarge,form.xxlarge|integer|min:10|max:100',
            'form.xlarge'  => 'required_without_all:form.xxsmall,form.xsmall,form.small,form.medium,form.large,form.xxlarge|integer|min:10|max:100',
            'form.xxlarge'  => 'required_without_all:form.xxsmall,form.xsmall,form.small,form.medium,form.large,form.xlarge|integer|min:10|max:100',
        ];
    }

    protected $validationAttributes = [
        'form.prd_name' => 'product name',
        'form.prd_description' => 'product description',
        'form.prd_price' => 'product price',
        'form.prd_image' => 'product image',
        'form.prd_3d' => 'product model',
        'form.xxsmall'  => 'xxsmall',
        'form.xsmall'  => 'xsmall',
        'form.small'  => 'small',
        'form.medium'  => 'medium',
        'form.large'  => 'large',
        'form.xlarge'  => 'xlarge',
        'form.xxlarge'  => 'xxlarge',
    ];

    public function render()
    {
        return view('livewire.products.products-create');
    }

    public function store()
    {
        $this->validate();

        $prdImage = $this->form['prd_image'];

        $newProductImageName = $this->form['prd_name'] . Str::random(30) . '.' . $prdImage->extension();

        $prdImagePath = $prdImage->storeAs('/images/products', $newProductImageName,'public');

        $prdModel = $this->form['prd_3d'];

        $newProductModelName = $this->form['prd_name'] . Str::random(30) . '.' . $prdModel->extension();

        $prdModelPath = $prdModel->storeAs('/images/models', $newProductModelName,'public');
        
        $product = Product::create([
            'prd_name' => $this->form['prd_name'],
            'prd_description' => $this->form['prd_description'],
            'prd_price' => $this->form['prd_price'],
            'prd_image' => $prdImagePath,
            'prd_3d' => $prdModelPath,
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

        $productStocks = array_filter($productStocks);

        $product->product_stock()->create($productStocks);
    
        
        $this->clearFormFields();

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been created successfully!'); 
    }

    public function clearFormFields()
    {
        $this->form['prd_name'] = '';
        $this->form['prd_description'] = '';
        $this->form['prd_price'] = '';
        $this->form['prd_image'] = null;
        $this->form['prd_3d'] = null;
        $this->form['xxsmall'] = '';
        $this->form['xsmall'] = '';
        $this->form['small'] = '';
        $this->form['medium'] = '';
        $this->form['large'] = '';
        $this->form['xlarge'] = '';
        $this->form['xxlarge'] = '';
    }

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');
        $this->emitUp('closeCreateModal');
    }
}
