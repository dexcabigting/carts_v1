<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductsEdit extends Component
{
    public $product;

    public $form = [
        'prd_name' => '',
        'prd_description' => '',
        'prd_price' => '',
    ];

    protected $listeners = [
        'getProductId',
    ];

    protected function rules()
    {
        return [
            'form.prd_name' => 'required|string|max:255',
            'form.prd_description' => 'required|string|max:255',
            'form.prd_price' => 'required|numeric|regex:/^\d+(\.\d{2})?$/',
        ];
    }

    protected $validationAttributes = [
        'form.prd_name' => 'product name',
        'form.prd_description' => 'product description',
        'form.prd_price' => 'product price',
    ];

    public function mount(Product $id)
    {
        $this->form['prd_name'] = $id->prd_name;
        $this->form['prd_description'] = $id->prd_description;
        $this->form['prd_price'] = $id->prd_price;

        $this->product = $id;
    }
        
    public function render()
    {
        return view('livewire.products.products-edit');
    }

    public function getProductId(Product $id)
    {
        $this->mount($id);
    }

    public function update()
    {
        $this->validate();

        $this->product->update([
            'prd_name' => $this->form['prd_name'],
            'prd_description' => $this->form['prd_description'],
            'prd_price' => $this->form['prd_price'],
        ]);

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been updated successfully!');
    }

    public function closeEditModal()
    {
        $this->emitUp('closeEditModal');
    }
}
