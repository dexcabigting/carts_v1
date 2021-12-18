<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

use App\Service\Twilio\PhoneNumberLookupService;

use App\Rules\PhoneNumber;

class ProfileIndexCredentials extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
    ];

    protected function rules()
    {
        $service = app()->make(PhoneNumberLookupService::class);
        
        return [
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'form.phone' => ['required', 'string', 'unique:users,phone', new PhoneNumber($service)],
        ];
    }

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
