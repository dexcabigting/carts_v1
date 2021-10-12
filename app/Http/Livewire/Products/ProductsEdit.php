<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductStock;
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
        'category_id' => '',
        'fabric_id' => '',
        'prd_description' => '',
        'prd_price' => '',
    ];

    public $addVariants;
    public $categories = [];
    public $fabrics = [];
    public $productVariants = [];
    public $deleteExisting = [];

    protected $listeners = [
        'closeEdit',
    ];

    protected function rules()
    {
        return [
            'form.prd_name' => 'required|string|max:100|unique:products,prd_name,' . $this->product->id,
            'form.prd_category' => 'nullable|string|max:100|exists:categories,id',
            'form.prd_fabric' => 'nullable|string|max:100|exists:fabrics,id',
            'form.prd_description' => 'required|string|max:100',
            'form.prd_price' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
            'addVariants.*.prd_var_name' => 'required|string|max:100',
            'addVariants.*.front_view' => 'required',
            'addVariants.*.back_view' => 'required',
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

        $this->productVariants = ProductVariant::with('product_stock')
        ->where('product_id', $this->product->id)->get();

        $this->form = $this->product->toArray();

        $this->addVariants = [];

        foreach($this->productVariants as $productVariant) {
            $array = [
                'id' => $productVariant->id,
                'prd_var_name' => $productVariant->prd_var_name,
                'front_view' => Str::random(5),
                'back_view' =>  Str::random(5),
                '2XS' => $productVariant->product_stock->xxsmall,
                'XS' => $productVariant->product_stock->xsmall,
                'S' => $productVariant->product_stock->small,
                'M' => $productVariant->product_stock->medium,
                'L' => $productVariant->product_stock->large,
                'XL' => $productVariant->product_stock->xlarge,
                '2XL' => $productVariant->product_stock->xxlarge,
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
    
        $this->product->update([
            'prd_name' => $this->form['prd_name'],
            'category_id' => $this->form['category_id'],
            'fabric_id' => $this->form['fabric_id'],
            'prd_description' => $this->form['prd_description'],
            'prd_price' => $this->form['prd_price'],
        ]);

        $oldVariants = array_filter($this->addVariants, function ($var) {
            return ($var['id'] != null);
        });

        $this->updateExisting($oldVariants);


        if(count($this->addVariants) > count($oldVariants)) {
            // For new variants 
            $newVariants = array_filter($this->addVariants, function ($var) {
                return ($var['id'] == null);
            });

            $newVariants = array_values($newVariants);

            $this->createNewVariants($newVariants);
        }

        if($this->deleteExisting) {
            $this->deleteExistingVariants($this->deleteExisting);
        }

        $this->product->refresh();

        $this->mount($this->product);

        $this->deleteExisting = [];

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been updated successfully!');
    }

    private function updateExisting($oldVariants)
    {

        $oldCount = count($oldVariants);

        for($i = 0; $i < $oldCount; $i++) {
            $oldProductVariant = ProductVariant::where('id', $oldVariants[$i]['id'])->first();

            $oldVariant = [
                'prd_var_name' => $oldVariants[$i]['prd_var_name'],
                'front_view' => $oldVariants[$i]['front_view'],
                'back_view' => $oldVariants[$i]['back_view'],
            ];

            $oldSizes = [
                '2XS' => $oldVariants[$i]['2XS'],
                'XS' => $oldVariants[$i]['XS'],
                'S' => $oldVariants[$i]['S'],
                'M' => $oldVariants[$i]['M'],
                'L' => $oldVariants[$i]['L'],
                'XL' => $oldVariants[$i]['XL'],
                '2XL' => $oldVariants[$i]['2XL'],
            ];

            $oldSizes = array_filter($oldSizes);   
            
            $oldProductVariant->update($oldVariant);

            $oldProductVariant->product_stock()->update($oldSizes);
        }
    }

    private function createNewVariants($newVariants)
    {

        $product = $this->product;

        $newCount = count($newVariants);

        $newSizes = [];

            for($i = 0; $i < $newCount; $i++) {
                $variantFront = $this->addVariants[$i]['front_view'];
                $variantBack = $this->addVariants[$i]['back_view'];

                $newFrontName = $this->addVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $variantFront->extension();
                $newBackName = $this->addVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $variantBack->extension();
            
                $frontImagePath = $variantFront->storeAs('/images/products', $newFrontName,'public');
                $backImagePath = $variantBack->storeAs('/images/products', $newBackName,'public');


                $variants[] = [
                    'prd_var_name' => $newVariants[$i]['prd_var_name'],
                    'front_view' => $frontImagePath,
                    'back_view' => $backImagePath,
                ];

                $sizes = [
                    '2XS' => $newVariants[$i]['2XS'],
                    'XS' => $newVariants[$i]['XS'],
                    'S' => $newVariants[$i]['S'],
                    'M' => $newVariants[$i]['M'],
                    'L' => $newVariants[$i]['L'],
                    'XL' => $newVariants[$i]['XL'],
                    '2XL' => $newVariants[$i]['2XL'],
                ];

                $sizes = array_filter($sizes);   
                
                array_push($newSizes, $sizes);
            }

            $productVariants = $product->product_variants()->createMany($variants);

            for($i = 0; $i < $newCount; $i++) {
                $productVariants->get($i)->product_stock()->create($newSizes[$i]);
            }
    }

    private function deleteExistingVariants($deleteExisting)
    {
        ProductVariant::whereIn('id', $deleteExisting)->delete();
    }

    public function addMore()
    {
        if(count($this->addVariants) == 5) {
            session()->flash('fail', 'Only 5 variants are allowed!'); 
        } else {
            $this->addVariants[] = [
                'id' => null,
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
        $id = $this->addVariants[$index]['id'];

        if($id !== NULL) {
            array_push($this->deleteExisting, $id);
        }

        unset($this->addVariants[$index]);

        $this->addVariants = array_values($this->addVariants);
    }

    public function closeEditModal()
    {
        $this->deleteExisting = [];

        $this->resetValidation();

        $this->dispatchBrowserEvent('editModalDisplayNone');
        
        $this->emitUp('closeEditModal');
    }
}
