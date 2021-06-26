<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersCreate extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    protected function rules()
    {
        return [
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|string|email|max:255|unique:users,email',
            'form.password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
    
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

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
    }
}