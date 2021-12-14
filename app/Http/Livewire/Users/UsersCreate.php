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
        'role_id' => '',
        'verify_email' => '',
        'region' => '',
        'province' => '',
        'city' => '',
        'barangay' => '',
        'home_address' => '',
        'is_main_address' => ''
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
            'form.role_id' => ['required', 'exists:roles,id'],
            'form.verify_email' => ['required', 'in:Yes,No'],
            'form.region' => ['required', 'string'],
            'form.province' => ['required', 'string'],
            'form.city' => ['required', 'string'],
            'form.barangay' => ['required', 'string'],
            'form.home_address' => ['required', 'string'],
            'form.is_main_address' => ['required', 'string']
        ];
    }
    
    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email address',
        'form.phone' => 'phone number',
        'form.password' => 'password',
        'form.password_confirmation' => 'confirm password',
        'form.role_id' => 'role_id',
        'form.verify_email' => 'verify email',
        'form.region' => 'region',
        'form.province' => 'province',
        'form.city' => 'city',
        'form.barangay' => 'barangay',
        'form.home_address' => 'home address',
        'form.is_main_address' => 'default'
    ];

    public function mount()
    {
        $this->roles = Role::get(['id', 'role'])->toArray();

        $this->yesOrNo = ['Yes', 'No'];
    }

    public function render()
    {
        return view('livewire.users.users-create');
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('loadRegions');
    }

    public function store($formData)
    {
        $phone = preg_replace('/^(09)(\d+)/', '639$2', $this->form['phone']);

        $this->form['phone'] = $phone;

        $this->form['region'] = $formData['create_region'];
        $this->form['province'] = $formData['create_province'];
        $this->form['city'] = $formData['create_city'];
        $this->form['barangay'] = $formData['create_barangay'];
        $this->form['home_address'] = $formData['create_home_address'];
        $this->form['is_main_address'] = $formData['is_main_address'];

        $this->form['verify_email'] = $formData['verify_email'];

        $this->form['role_id'] = $formData['role_id'];

        $this->validate();

        dd($this->form);
        
        $user = User::create([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
            'password' => Hash::make($this->form['password']),
            'role_id' => $this->form['role_id'],
            'email_verified_at' => ($this->form['verify_email'] == "Yes") ? now() : null
        ]);

        if($this->form['is_main_address'] == "1") {
            $user->userAddresses()
                ->where('is_main_address', 1)
                ->update(['is_main_address' => 0]);
        }

        $user->userAddresses()->create([
            'region' => $this->form['region'],
            'province' => $this->form['province'],
            'city' => $this->form['city'],
            'barangay' => $this->form['barangay'],
            'home_address' => $this->form['home_address'],
            'is_main_address' => $this->form['is_main_address'],
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
