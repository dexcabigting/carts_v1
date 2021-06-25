<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class UsersEdit extends Component
{
    public $user;

    public $form = [
        'name' => '',
        'email' => '',
    ];

    protected function rules()
    {
        return [
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
        ];
    }

    public function mount(User $id)
    {
        $this->form = $id;

        $this->user = $id;
    }

    public function render()
    {
        return view('livewire.users.users-edit');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
        ]);

        session()->flash('success', 'User has been updated successfully!');
    }
}
