<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class ProfileIndexCredentials extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
    ];

    public function mount()
    {
        $user = auth()->user();

        $this->form = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone
        ];
    }

    public function render()
    {
        return view('livewire.profile.profile-index-credentials');
    }
}
