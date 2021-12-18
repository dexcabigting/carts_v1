<?php

namespace App\Http\Livewire\ResponsiveSettings;

use Livewire\Component;

class ResponsiveSettingsNameAndEmail extends Component
{
    public $name;
    public $email;

    protected $listeners = [
        'updatedNameAndEmail' => 'updateResponsiveSettingsNameAndEmail'
    ];

    public function render()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;

        return view('livewire.responsive-settings.responsive-settings-name-and-email');
    }

    public function updateResponsiveSettingsNameAndEmail($name, $email)
    {
        return [
            $this->name = $name,
            $this->email = $email,
        ];
    }

    
}
