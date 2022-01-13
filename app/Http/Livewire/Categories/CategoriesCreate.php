<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;

use App\Models\Category;

use Exception;

use Illuminate\Support\Facades\DB;

class CategoriesCreate extends Component
{
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

    public function render()
    {
        return view('livewire.categories.categories-create');
    }

    public function store()
    {
        $this->validate();

        try {
            DB::transaction(function() {
                Category::create([
                    'ctgr_name' => $this->form['ctgr_name'],
                    'ctgr_description' => $this->form['ctgr_description'],
                ]);

                $this->reset(['form']);

                $this->emitUp('refreshParent');

                session()->flash('success', 'Category has been successfully created!');  
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');
        $this->emitUp('closeCreateModal');
    }
}
