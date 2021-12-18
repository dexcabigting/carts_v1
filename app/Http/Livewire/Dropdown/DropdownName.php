<?php

namespace App\Http\Livewire\Dropdown;

use Livewire\Component;

class DropdownName extends Component
{
    public $name;

    protected $listeners = [
        'updatedName' => 'updateDropdownName'
    ];

    public function render()
    {
        $this->name = auth()->user()->name;

        return view('livewire.dropdown.dropdown-name');
    }

    public function updateDropdownName($name)
    {
        return $this->name = $name;
    }
}
