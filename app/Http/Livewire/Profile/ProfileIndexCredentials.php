<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

use App\Service\Twilio\PhoneNumberLookupService;

use App\Rules\PhoneNumber;

class ProfileIndexCredentials extends Component
{
    public $user;
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
            'form.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'form.phone' => ['required', 'string', 'unique:users,phone,' . $this->user->id, new PhoneNumber($service)]
        ];
    }

    public function mount()
    {
        $this->user = auth()->user();

        $this->form = [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'phone' => $this->user->phone
        ];
    }

    public function render()
    {
        return view('livewire.profile.profile-index-credentials');
    }

    public function updateCredentials()
    {
        $phone = preg_replace( '/^(09)(\d+)/', '639$2', $this->form['phone']);

        $this->form['phone'] = $phone;

        $this->validate();

        $oldName = $this->user->name;
        $oldEmail = $this->user->email;

        $this->user->update([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
        ]);

        if($oldName != $this->form['name']) {
            $this->emit('updatedName', $this->form['name']);
        }

        if($oldName != $this->form['name'] && $oldEmail != $this->form['email']) {
            $this->emit('updatedNameAndEmail', $this->form['name'], $this->form['email']);
        }

        $this->user->refresh();

        session()->flash('success', 'Credentials have been successfully updated!');  
    }
}
