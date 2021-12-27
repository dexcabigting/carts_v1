<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class CategoriesCreate extends Component
{
    public $form = [
        'ctgr_name' => '',
        'ctgr_description' => '',
    ];

    protected $rules = [
        'form.ctgr_name' => 'required|string|max:100|regex:/^([A-Z0-9]+ ?)+$/i',
        'form.ctgr_description' => 'required|string|max:100',
    ];

    protected $validationAttributes = [
        'form.ctgr_name' => 'category name',
        'form.ctgr_description' => 'category description',
    ];

    public function render()
    {
        return view('livewire.categories.categories-create');
    }

    public function store()
    {
        $this->validate();

        Category::create([
            'ctgr_name' => $this->form['ctgr_name'],
            'ctgr_description' => $this->form['ctgr_description'],
        ]);

        $this->clearFormFields();

        $this->emitUp('refreshParent');

        session()->flash('success', 'Category has been created successfully!'); 
    }

    public function clearFormFields()
    {
        $this->form = [
            'ctgr_name' => '',
            'ctgr_description' => '',
        ];
    }

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');
        $this->emitUp('closeCreateModal');
    }
}
