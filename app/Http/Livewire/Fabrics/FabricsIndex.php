<?php

namespace App\Http\Livewire\Fabrics;

use Livewire\Component;
use App\Models\Fabric;
use Livewire\WithPagination;

class FabricsIndex extends Component
{
    use WithPagination;

    public $form = [
        'name' => '',
        'description' => '',
    ];

    protected $rules = [
        'form.name' => 'required|string',
        'form.description' => 'required|string',
    ];

    protected $validationAttributes = [
        'form.name' => 'fabric name',
        'form.description' => 'fabric description',
    ];

    public function mount()
    {
        $this->fabrics = Fabric::all();
    }

    public function render()
    {
        return view('livewire.fabrics.fabrics-index')->layout('layouts.app');
    }

    public function addFabric()
    {
        $this->validate();

        Fabric::create([
            'fab_name' => $this->form['name'],
            'fab_description' => $this->form['description'],
        ]);

        session()->flash('success', 'Fabric has been successfully created!');

        $this->form = [
            'name' => '',
            'description' => '',
        ];

        $this->fabrics->refresh();
    }
}
