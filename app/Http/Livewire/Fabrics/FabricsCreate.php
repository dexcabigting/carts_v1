<?php

namespace App\Http\Livewire\Fabrics;

use Livewire\Component;

use App\Models\Fabric;

use Exception;

use Illuminate\Support\Facades\DB;

class FabricsCreate extends Component
{
    public $form = [
        'fab_name' => "",
        'fab_description' => "",
    ];

    protected $rules = [
        'form.fab_name' => 'required|string|max:15',
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

        try {
            DB::transaction(function() {
                Fabric::create([
                    'fab_name' => $this->form['fab_name'],
                    'fab_description' => $this->form['fab_description'],
                ]);

                $this->reset(['form']);

                $this->emitUp('refreshParent');

                session()->flash('success', 'Fabric has been successfully created!'); 
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
