<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Service\Twilio\PhoneNumberLookupService;

use App\Rules\PhoneNumber;

class UsersCreate extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'password' => '',
        'password_confirmation' => '',
        'role' => '',
        'verify_email' => '',
    ];
    public $roles = [];
    public $yesOrNo = [];

    protected function rules()
    {
        $service = app()->make(PhoneNumberLookupService::class);
        
        return [
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'form.phone' => ['required', 'string', 'unique:users,phone', new PhoneNumber($service)],
            'form.password' => ['required', 'confirmed', Rules\Password::defaults()],
            'form.role' => ['required', 'exists:roles,id'],
            'form.verify_email' => ['required', 'in:Yes,No']
        ];
    }
    
    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email address',
        'form.phone' => 'phone number',
        'form.password' => 'password',
        'form.password_confirmation' => 'confirm password',
        'form.role' => 'role',
        'form.verify_email' => 'verify email',
    ];

    public function mount()
    {
        $this->roles = Role::get(['id', 'role'])->toArray();

        $this->yesOrNo = ['Yes', 'No'];

        // dd($this->yesOrNo);
    }

    public function render()
    {
        return view('livewire.users.users-create');
    }

    public function store()
    {
        // dd(($this->form['verify_email'] == "Yes") ? now() : null);
        $phone = preg_replace('/^(09)(\d+)/', '639$2', $this->form['phone']);

        $this->form['phone'] = $phone;

        $this->validate();
        
        User::create([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
            'password' => Hash::make($this->form['password']),
            'role_id' => $this->form['role'],
            'email_verified_at' => ($this->form['verify_email'] == "Yes") ? now() : null
        ]);

        $this->reset(['form']);

        $this->emitUp('refreshParent');

        session()->flash('success', 'User has been created successfully!'); 
    }

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');
        $this->emitUp('closeCreateModal');
    }
}
