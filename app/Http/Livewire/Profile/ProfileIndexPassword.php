<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ProfileIndexPassword extends Component
{
    public $form = [
        'current_password' => "",
        'new_password' => "",
        'new_password_confirmation' => ""
    ];

    protected function rules()
    {
        return [
            'form.current_password' => ['required', Rules\Password::defaults()],
            'form.new_password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    protected $validationAttributes = [
        'form.current_password' => 'current password',
        'form.new_password' => 'new password',
        'form.new_password_confirmation' => 'new password confirmation'
    ];

    public function render()
    {
        return view('livewire.profile.profile-index-password');
    }

    public function updatePassword()
    {
        $this->validate();

        $user = auth()->user();

        if(!Hash::check($this->form['current_password'], $user->password)) {
            $this->reset(['form']);

            session()->flash('fail', 'Your password does not match our records!');
        } else {
            $user->update([
                'password' => Hash::make($this->form['new_password'])
            ]);

            $this->reset(['form']);

            session()->flash('success', 'Your password has been successfully updated!');
        }
    }
}
