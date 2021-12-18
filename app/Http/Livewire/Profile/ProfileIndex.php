<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class ProfileIndex extends Component
{
    public function render()
    {
        $layout = (auth()->user()->role_id == 1) ? 'layouts.app' : 'layouts.app-user';
        return view('livewire.profile.profile-index')->layout($layout);
    }
}
