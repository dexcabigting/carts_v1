<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;


class CategoriesIndex extends Component
{

    public $form = [
        'name' => '',
        'description' => '',
    ];

    protected $rules = [
        'form.name' => 'required|string',
        'form.description' => 'required|string',
    ];

    protected $validationAttributes = [
        'form.name' => 'category name',
        'form.description' => 'category description',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.categories.categories-index')->layout('layouts.app');
    }

    public function addCategory()
    {
        $this->validate();

        Category::create([
            'ctgr_name' => $this->form['name'],
            'ctgr_description' => $this->form['description'],
        ]);

        session()->flash('success', 'Category has been successfully created!');

        $this->form = [
            'name' => '',
            'description' => '',
        ];

        $this->mount();
    }
}
