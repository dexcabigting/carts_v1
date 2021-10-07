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
        '2XS'  => '',
        'XS'  => '',
        'S'  => '',
        'M'  => '',
        'L'  => '',
        'XL'  => '',
        '2XL'  => '',
    ];
    public $addVariants;

    protected function rules()
    {
        return [
            'form.prd_name' => 'required|string|max:255|unique:products,prd_name',
            'form.prd_description' => 'required|string|max:255',
            'form.prd_price' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
            'form.2XS'  => 'required_without_all:form.XS,form.S,form.M,form.L,form.XL,form.2XL|integer|min:10|max:100',
            'form.XS'  => 'required_without_all:form.2XS,form.S,form.M,form.L,form.XL,form.2XL|integer|min:10|max:100',
            'form.S'  => 'required_without_all:form.2XS,form.XS,form.M,form.L,form.XL,form.2XL|integer|min:10|max:100',
            'form.M'  => 'required_without_all:form.2XS,form.XS,form.S,form.L,form.XL,form.2XL|integer|min:10|max:100',
            'form.L'  => 'required_without_all:form.2XS,form.XS,form.S,form.M,form.XL,form.2XL|integer|min:10|max:100',
            'form.XL'  => 'required_without_all:form.2XS,form.XS,form.S,form.M,form.L,form.2XL|integer|min:10|max:100',
            'form.2XL'  => 'required_without_all:form.2XS,form.XS,form.S,form.M,form.L,form.XL|integer|min:10|max:100',
            'addVariants.*.prd_var_name' => 'required|string|max:255|unique:product_variants,prd_var_name',
            'addVariants.*.front_view' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'addVariants.*.back_view' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    protected $validationAttributes = [
        'form.prd_name' => 'product name',
        'form.prd_description' => 'product description',
        'form.prd_price' => 'product price',
        'form.2XS'  => '2XS',
        'form.XS'  => 'XS',
        'form.S'  => 'S',
        'form.M'  => 'M',
        'form.L'  => 'L',
        'form.XL'  => 'XL',
        'form.2XL'  => '2XL',
        'addVariants.*.size' => '*Jersey Size',
        'addVariants.*.surname' => 'Jersey Surname',
        'addVariants.*.jersey_number' => 'Jersey Number',
    ];

    public function mount()
    {
        $this->addVariants = [
            [
                'prd_var_name' => '',
                'front_view' => null,
                'back_view' => null,
            ]
        ];
    }

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
            '2XS' => $this->form['2XS'],
            'XS' => $this->form['XS'],
            'S' => $this->form['S'],
            'M' => $this->form['M'],
            'L' => $this->form['L'],
            'XL' => $this->form['XL'],
            '2XL' => $this->form['2XL'],
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
        $this->form['2XS'] = '';
        $this->form['XS'] = '';
        $this->form['S'] = '';
        $this->form['M'] = '';
        $this->form['L'] = '';
        $this->form['XL'] = '';
        $this->form['2XL'] = '';

        $this->addVariants = [
            [
                'prd_var_name' => '',
                'front_view' => null,
                'back_view' => null,
            ]
        ];
    }

    public function addMore()
    {
        $this->addVariants[] = [
            'prd_var_name' => '',
            'front_view' => null,
            'back_view' => null,
        ];
    }

    public function removeVariant($index)
    {
        unset($this->addVariants[$index]);

        $this->addVariants = array_values($this->addVariants);
    }

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');
        $this->emitUp('closeCreateModal');
    }
}
