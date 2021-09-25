<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductsCreate extends Component
{
    public $form = [
        'prd_name' => '',
        'prd_description' => '',
        'prd_price' => '',
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

    public function render()
    {
        return view('livewire.products.products-create');
    }

    public function store()
    {
        $this->validate();
        
        Product::create([
            'prd_name' => $this->form['prd_name'],
            'prd_description' => $this->form['prd_description'],
            'prd_price' => $this->form['prd_price'],
        ]);

        $this->clearFormFields();

        $this->emitUp('refreshParent');

        session()->flash('success', 'Product has been added successfully!'); 
    }

    public function clearFormFields()
    {
        $this->form['prd_name'] = '';
        $this->form['prd_description'] = '';
        $this->form['prd_price'] = '';
    }

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');
        $this->emitUp('closeCreateModal');
    }
}
