<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Service\Twilio\PhoneNumberLookupService;
use App\Rules\PhoneNumber;

class UsersCreate extends Component
{
    private $service;

    public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    protected function rules()
    {
        return [
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|string|email|max:255|unique:users,email',
            'form.phone' => ['required', 'string', 'unique:users,phone', new PhoneNumber($this->service)],
            'form.password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
    
    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email address',
        'form.phone' => 'phone number',
        'form.password' => 'password',
        'form.password_confirmation' => 'confirm password',
    ];



    public function render()
    {
        return view('livewire.users.users-create');
    }

    public function store(PhoneNumberLookupService $service)
    {
        $this->service = $service;

        $phone = preg_replace( '/^(09)(\d+)/', '639$2', $this->form['phone']);

        $this->form['phone'] = $phone;

        $this->validate();
        
        User::create([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
            'password' => Hash::make($this->form['password']),
        ]);

        $this->form['name'] = '';
        $this->form['email'] = '';
        $this->form['phone'] = '';
        $this->form['password'] = '';
        $this->form['password_confirmation'] = '';

        session()->flash('success', 'User has been created successfully!'); 
    }
}
