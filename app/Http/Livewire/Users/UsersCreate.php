<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersCreate extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    protected $rules = [
        'form.name' => 'required|string|max:255',
        'form.email' => 'required|string|email|max:255|unique:users,email',
        'form.password' => 'required|confirmed|min:8',
    ];

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email address',
        'form.password' => 'password',
        'form.password_confirmation' => 'confirm password',
    ];

    public function render()
    {
        return view('livewire.users.users-create');
    }

    public function updatedFormName()
    {
        $this->validateOnly('form.name');
    }

    public function updatedFormEmail()
    {
        $this->validateOnly('form.email');
    }

    public function updatedFormPassword()
    {
        $this->validateOnly('form.password');
    }

    public function store()
    {
        $this->validate();
        
        User::create([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'password' => Hash::make($this->form['password']),
        ]);

        $this->form['name'] = '';
        $this->form['email'] = '';
        $this->form['password'] = '';
        $this->form['password_confirmation'] = '';

        session()->flash('success', 'User has been created successfully!');
        //dd($user);       
    }
}
