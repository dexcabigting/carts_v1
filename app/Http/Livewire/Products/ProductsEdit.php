<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Fabric;

use Exception;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductsEdit extends Component
{
    use WithFileUploads;

    public $imageID = 0;
    public $product;
    
     /**
     * @var ['prd_image'] mixed
     */
    public $form = [
        'prd_name' => "",
        'category_id' => "",
        'fabric_id' => "",
        'prd_description' => "",
        'prd_price' => "",
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
            'form.prd_name' => ['required', 'string', 'max:100', 'unique:products,prd_name,' . $this->product->id, 'regex:/^([A-Z0-9]+ ?)+$/i'],
            'form.category_id' => ['required', 'string', 'max:100', 'exists:categories,id'],
            'form.fabric_id' => ['required', 'string', 'max:100', 'exists:fabrics,id'],
            'form.prd_description' => ['required', 'string', 'max:100'],
            'form.prd_price' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
            'addVariants.*.id' => ['nullable', 'integer'],
            'addVariants.*.prd_var_name' => ['required', 'string', 'max:100', 'regex:/^([A-Z0-9]+ ?)+$/i'],
            'addVariants.*.front_view' => ['required_if:addVariants.*.id,""', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'addVariants.*.back_view' => ['required_if:addVariants.*.id,""', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'addVariants.*.2XS'  => ['filled', 'integer', 'max:999'],
            'addVariants.*.XS'  => ['filled', 'integer', 'max:999'],
            'addVariants.*.S'  => ['filled', 'integer', 'max:999'],
            'addVariants.*.M'  => ['filled', 'integer', 'max:999'],
            'addVariants.*.L'  => ['filled', 'integer', 'max:999'],
            'addVariants.*.XL'  => ['filled', 'integer', 'max:999'],
            'addVariants.*.2XL'  => ['filled', 'integer', 'max:999'],
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
    
    public function mount(Product $id)
    {
        $this->product = $id;

        $this->productVariants = ProductVariant::with('product_stock')
        ->where('product_id', $this->product->id)->get();

        $this->form = $this->product->toArray();

        $this->addVariants = [];

        foreach($this->productVariants as $productVariant) {
            $array = [
                'id' => (string)$productVariant->id,
                'prd_var_name' => $productVariant->prd_var_name,
                'front_view' => null,
                'back_view' => null,
                '2XS' => (string)$productVariant->product_stock->{'2XS'},
                'XS' => (string)$productVariant->product_stock->XS,
                'S' => (string)$productVariant->product_stock->S,
                'M' => (string)$productVariant->product_stock->M,
                'L' => (string)$productVariant->product_stock->L,
                'XL' => (string)$productVariant->product_stock->XL,
                '2XL' => (string)$productVariant->product_stock->{'2XL'},
                'variant_id' => 00,
            ];

            array_push($this->addVariants, $array);
        }
        
        $this->categories = Category::all(['id', 'ctgr_name']);

        $this->fabrics = Fabric::all(['id', 'fab_name']);
    }

    public function hydrate()
    {
        if(!empty($this->getErrorBag())) {
            $this->resetErrorBag();
        }
    }

    public function render()
    {
        return view('livewire.products.products-edit');
    }

    public function update()
    {
        $this->form['category_id'] = (string)$this->form['category_id'];
        $this->form['fabric_id'] = (string)$this->form['fabric_id'];
        $this->form['prd_price'] = number_format($this->form['prd_price'], 2);

        $this->validate();

        try {
            DB::transaction(function() {
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
                        return ($var['id'] == "");
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

                $this->imageID++;

                $this->emitUp('refreshParent');

                session()->flash('success', 'Product has been successfully updated!');
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error); 
        }  
    }

    private function updateExisting($oldVariants)
    {
        $oldCount = count($oldVariants);

        for($i = 0; $i < $oldCount; $i++) {
            $oldProductVariant = ProductVariant::where('id', $oldVariants[$i]['id'])->first();

            // Get path info of the variant from database
            $frontViewPath = pathinfo($oldProductVariant->front_view);
            $backViewPath = pathinfo($oldProductVariant->back_view);

            // Set new image path for both images
            $frontViewImagePath = $frontViewPath['dirname'] . '/' . $oldVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $frontViewPath['extension'];
            $backViewImagePath = $backViewPath['dirname'] . '/' . $oldVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $backViewPath['extension'];
            
            // if(($this->form['prd_name'] != $this->product->prd_name) || ($oldVariants[$i]['prd_var_name'] != $oldProductVariant->prd_var_name)) {
            // If admin changes the product name, product image name should be updated
            Storage::move('public/' . $oldProductVariant->front_view, 'public/' . $frontViewImagePath);
            Storage::move('public/' . $oldProductVariant->back_view, 'public/' . $backViewImagePath);

            if($oldVariants[$i]['front_view'] && $oldVariants[$i]['back_view']) {
                // If admin changes the product image, old image must be removed and replaced with a renamed image according to product name
                Storage::delete('public/' .$oldProductVariant->front_view);
                Storage::delete('public/' .$oldProductVariant->back_view);

                $frontImage = $oldVariants[$i]['front_view'];
                $frontViewImageName = $oldVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $frontImage->extension();
                $frontViewImagePath = $frontImage->storeAs('/images/products', $frontViewImageName,'public');

                $backImage = $oldVariants[$i]['back_view'];
                $backViewImageName = $oldVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $backImage->extension();
                $backViewImagePath = $backImage->storeAs('/images/products', $backViewImageName,'public');
            }

            $oldVariant = [
                'prd_var_name' => $oldVariants[$i]['prd_var_name'],
                'front_view' => $frontViewImagePath,
                'back_view' => $backViewImagePath,
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

            $oldSizes = array_map(function ($size) {
                return $size === "" ? 0 : $size ;
            }, $oldSizes);   

            
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
            $variantFront = $newVariants[$i]['front_view'];
            $variantBack = $newVariants[$i]['back_view'];

            $newFrontName = $newVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $variantFront->extension();
            $newBackName = $newVariants[$i]['prd_var_name'] . '-' . $this->form['prd_name'] . Str::random(10) . '.' . $variantBack->extension();
        
            $frontImagePath = $variantFront->storeAs('/images/products', $newFrontName, 'public');
            $backImagePath = $variantBack->storeAs('/images/products', $newBackName, 'public');

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
        $variants = ProductVariant::whereIn('id', $deleteExisting)->get();

        $variants->each(function ($variant) {
                        Storage::disk('root')->delete('app/public/' . $variant->front_view);
                        Storage::disk('root')->delete('app/public/' . $variant->back_view);
                    })
                    ->each
                    ->delete();
    }

    public function addMore()
    {
        if(count($this->addVariants) == 5) {
            session()->flash('fail', 'Only 5 variants are allowed!'); 
        } else {
            $this->addVariants[] = [
                'id' => "",
                'prd_var_name' => "",
                'front_view' => null,
                'back_view' => null,
                '2XS' => "0",
                'XS' => "0",
                'S' => "0",
                'M' => "0",
                'L' => "0",
                'XL' => "0",
                '2XL' => "0",
                'variant_id' => mt_rand(00, 99)
            ];
        }
    }

    public function removeVariant($index)
    {
        $id = $this->addVariants[$index]['id'];

        if($id !== "") {
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
