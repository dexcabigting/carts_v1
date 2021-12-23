<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Fabric;

class ProductsCreate extends Component
{
    /**
     * @var ['prd_image'] mixed
     */
    use WithFileUploads;

    public $form = [
        'prd_name' => '',
        'prd_category' => '',
        'prd_fabric' => '',
        'prd_description' => '',
        'prd_price' => '',
    ];
    public array $addVariants = [
        [
            'prd_var_name' => "",
            'front_view' => null,
            'back_view' => null,
            '2XS'  => "",
            'XS'  => "",
            'S'  => "",
            'M'  => "",
            'L'  => "",
            'XL'  => "",
            '2XL'  => "",
        ]
    ];
    public $categories = [];
    public $fabrics = [];

    protected function rules()
    {
        return [
            'form.prd_name' => ['required', 'string', 'max:100', 'unique:products,prd_name', 'regex:/^([A-Z0-9]+ ?)+$/i'],
            'form.prd_category' => ['required', 'string', 'max:100', 'exists:categories,id'],
            'form.prd_fabric' => ['required', 'string', 'max:100', 'exists:fabrics,id'],
            'form.prd_description' => ['required', 'string', 'max:100'],
            'form.prd_price' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
            'addVariants.*.prd_var_name' => ['required', 'string', 'max:100', 'regex:/^([A-Z0-9]+ ?)+$/i'],
            'addVariants.*.front_view' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'addVariants.*.back_view' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'addVariants.*.2XS'  => ['required_without_all:addVariants.*.XS,addVariants.*.S,addVariants.*.M,addVariants.*.L,addVariants.*.XL,addVariants.*.2XL', 'integer', 'max:999'],
            'addVariants.*.XS'  => ['required_without_all:addVariants.*.2XS,addVariants.*.S,addVariants.*.M,addVariants.*.L,addVariants.*.XL,addVariants.*.2XL', 'integer', 'max:999'],
            'addVariants.*.S'  => ['required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.M,addVariants.*.L,addVariants.*.XL,addVariants.*.2XL', 'integer', 'max:999'],
            'addVariants.*.M'  => ['required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.S,addVariants.*.L,addVariants.*.XL,addVariants.*.2XL', 'integer', 'max:999'],
            'addVariants.*.L'  => ['required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.S,addVariants.*.M,addVariants.*.XL,addVariants.*.2XL', 'integer', 'max:999'],
            'addVariants.*.XL'  => ['required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.S,addVariants.*.M,addVariants.*.L,addVariants.*.2XL', 'integer', 'max:999'],
            'addVariants.*.2XL'  => ['required_without_all:addVariants.*.2XS,addVariants.*.XS,addVariants.*.S,addVariants.*.M,addVariants.*.L,addVariants.*.XL', 'integer', 'max:999'],
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

    protected $messages = [
        'addVariants.*.front_view.required_if' => 'Front view image is required for new variants.',
        'addVariants.*.back_view.required_if' => 'Back view image is required for new variants.',
    ];

    public function mount()
    {
        $this->categories = Category::all(['id', 'ctgr_name']);

        $this->fabrics = Fabric::all(['id', 'fab_name']);
    }

    public function render()
    {
        return view('livewire.products.products-create');
    }

    public function store()
    {
        $this->validate();

        $count = count($this->addVariants);

        $productVariants = [];

        $productStocks = [];

        for($i = 0; $i < $count; $i++) {
            $variantFront = $this->addVariants[$i]['front_view'];
            $variantBack = $this->addVariants[$i]['back_view'];

            $newFrontName = $this->addVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $variantFront->extension();
            $newBackName = $this->addVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $variantBack->extension();
        
            $frontImagePath = $variantFront->storeAs('/images/products', $newFrontName,'public');
            $backImagePath = $variantBack->storeAs('/images/products', $newBackName,'public');

            $productVariants[] = [
                'prd_var_name' => $this->addVariants[$i]['prd_var_name'],
                'front_view' => $frontImagePath,
                'back_view' => $backImagePath,
            ];

            $productVariantsStocks = [
                '2XS' => $this->addVariants[$i]['2XS'],
                'XS' => $this->addVariants[$i]['XS'],
                'S' => $this->addVariants[$i]['S'],
                'M' => $this->addVariants[$i]['M'],
                'L' => $this->addVariants[$i]['L'],
                'XL' => $this->addVariants[$i]['XL'],
                '2XL' => $this->addVariants[$i]['2XL'],
            ];

            $productVariantsStocks = array_filter($productVariantsStocks);

            array_push($productStocks, $productVariantsStocks);
        }
        
        $product = Product::create([
            'prd_name' => $this->form['prd_name'],
            'category_id' => $this->form['prd_category'],
            'fabric_id' => $this->form['prd_fabric'],
            'prd_description' => $this->form['prd_description'],
            'prd_price' => $this->form['prd_price'],
            // 'prd_image' => $prdImagePath,
        ]);

        $productVariants = $product->product_variants()->createMany($productVariants);

        for($i = 0; $i < $count; $i++) {
            $productVariants->get($i)->product_stock()->create($productStocks[$i]);
        }
        
        $this->clearFormFields();

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been created successfully!'); 
    }

    public function clearFormFields()
    {
        $this->form['prd_name'] = '';
        $this->form['prd_description'] = '';
        $this->form['prd_price'] = '';
        $this->form['prd_category'] = '';
        $this->form['prd_fabric'] = '';

        $this->addVariants = [
            [
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
            ]
        ];
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

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');
        $this->emitUp('closeCreateModal');
    }
}
