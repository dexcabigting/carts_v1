<?php

namespace App\Http\Livewire\Fabrics;

use Livewire\Component;

use App\Models\Fabric;

use Exception;

use Illuminate\Support\Facades\DB;

class FabricsDelete extends Component
{
    public $fabrics = [];

    public $promptDelete = 1;
    public $promptDeleted = 0;

    public function mount(...$id)
    {
        $this->fabrics = collect($id)->flatten()->toArray();
    }

    public function render()
    {
        return view('livewire.fabrics.fabrics-delete');
    }

    public function deleteFabrics()
    {
        if (count($this->fabrics) == 1) {
            $flash = 'Fabric has been successfully deleted!';
        } else {
            $flash = 'Fabrics have been successfully deleted!';
        }
            
        Fabric::whereIn('id', $this->fabrics)->delete();

        $this->emitUp('unsetCheckedFabrics', $this->fabrics);

        $this->emitUp('cleanse');

        $this->emitUp('refreshParent');

        session()->flash('success', $flash);

        $this->fabrics = [];

        $this->promptDelete = 0;
        $this->promptDeleted = 1;
    }

    public function closeDeleteModal()
    {
        $this->dispatchBrowserEvent('deleteModalDisplayNone');
        $this->emitUp('closeDeleteModal');
    }
}
