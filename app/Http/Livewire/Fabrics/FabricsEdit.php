<?php

namespace App\Http\Livewire\Fabrics;

use Livewire\Component;

use App\Models\Fabric;

use Exception;

use Illuminate\Support\Facades\DB;

class FabricsEdit extends Component
{
    public $fabric;
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

    public function mount(Fabric $id)
    {
        $this->fabric = $id;
        $this->form = $id;
    }

    public function render()
    {
        return view('livewire.fabrics.fabrics-edit');
    }

    public function update()
    {
        $this->validate();

        try {
            DB::transaction(function() {
                $this->fabric->update([
                    'fab_name' => $this->form['fab_name'],
                    'fab_description' => $this->form['fab_description'],
                ]);

                $this->mount($this->fabric);

                $this->emitUp('refreshParent');

                session()->flash('success', 'Fabric has been successfully updated!'); 
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
