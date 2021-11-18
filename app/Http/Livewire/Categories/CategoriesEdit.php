<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class CategoriesEdit extends Component
{
    public $category;
    public $form = [
        'ctgr_name' => '',
        'ctgr_description' => '',
    ];

    protected $rules = [
        'form.ctgr_name' => 'required|string|max:255',
        'form.ctgr_description' => 'required|string|max:255',
    ];

    protected $validationAttributes = [
        'form.ctgr_name' => 'category name',
        'form.ctgr_description' => 'category description',
    ];

    public function mount(Category $id)
    {
        $this->category = $id;
        $this->form = $id;
    }

    public function render()
    {
        return view('livewire.categories.categories-edit');
    }

    public function update()
    {
        $this->validate();

        $this->category->update([
            'ctgr_name' => $this->form['ctgr_name'],
            'ctgr_description' => $this->form['ctgr_description'],
        ]);

        $this->mount($this->category);

        $this->emitUp('refreshParent');

        session()->flash('success', 'Category has been updated successfully!'); 
    }

    public function closeEditModal()
    {
        $this->resetValidation();

        $this->dispatchBrowserEvent('editModalDisplayNone');
        
        $this->emitUp('closeEditModal');
    }
}
