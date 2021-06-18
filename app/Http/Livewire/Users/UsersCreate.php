<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class UsersCreate extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'password' => '',
    ];

    public function render()
    {
        return view('livewire.users.users-create');
    }

    public function store()
    {
        dd($this->form);
    }
}
