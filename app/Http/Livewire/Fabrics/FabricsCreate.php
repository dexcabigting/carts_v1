<?php

namespace App\Http\Livewire\Fabrics;

use Livewire\Component;
use App\Models\Fabric;

class FabricsCreate extends Component
{
    public $form = [
        'fab_name' => "",
        'fab_description' => "",
    ];

    protected $rules = [
        'form.fab_name' => 'required|string|max:100|regex:/^([A-Z0-9]+ ?)+$/i',
        'form.fab_description' => 'required|string|max:100',
    ];

    protected $validationAttributes = [
        'form.fab_name' => 'fabric name',
        'form.fab_description' => 'fabric description',
    ];

    public function render()
    {
        return view('livewire.fabrics.fabrics-create');
    }

    public function store()
    {
        $this->validate();

        Fabric::create([
            'fab_name' => $this->form['fab_name'],
            'fab_description' => $this->form['fab_description'],
        ]);

        $this->clearFormFields();

        $this->emitUp('refreshParent');

        session()->flash('success', 'Fabric has been created successfully!'); 
    }

    public function clearFormFields()
    {
        $this->reset(['form']);
    }

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');
        $this->emitUp('closeCreateModal');
    }
}
