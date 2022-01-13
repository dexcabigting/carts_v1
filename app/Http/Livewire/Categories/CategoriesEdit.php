<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;

use App\Models\Category;

use Exception;

use Illuminate\Support\Facades\DB;

class CategoriesEdit extends Component
{
    public $category;
    public $form = [
        'ctgr_name' => "",
        'ctgr_description' => "",
    ];

    protected $rules = [
        'form.ctgr_name' => 'required|string|max:15',
        'form.ctgr_description' => 'required|string|max:100',
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

        try {
            DB::transaction(function() {
                $this->category->update([
                    'ctgr_name' => $this->form['ctgr_name'],
                    'ctgr_description' => $this->form['ctgr_description'],
                ]);

                $this->mount($this->category);

                $this->emitUp('refreshParent');

                session()->flash('success', 'Category has been successfully updated!');  
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function closeEditModal()
    {
        $this->resetValidation();

        $this->dispatchBrowserEvent('editModalDisplayNone');
        
        $this->emitUp('closeEditModal');
    }
}
