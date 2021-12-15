<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use App\Models\User;

use Yajra\Address\Entities\Region;
use Yajra\Address\Entities\Province;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Barangay;

use App\Service\Twilio\PhoneNumberLookupService;

use App\Rules\PhoneNumber;

class UsersEdit extends Component
{
    public $user;

    public $form = [];
    public $selectedAddress;

    protected function rules()
    {   
        $service = app()->make(PhoneNumberLookupService::class);
        
        return [
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'form.phone' => ['required', 'string', 'unique:users,phone,' . $this->user->id, new PhoneNumber($service)],
        ];
    }

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email address',
        'form.phone' => 'phone number',
    ];

    public function mount(User $id)
    {
        $this->form = $id;

        $this->user = $id;

        $this->selectedAddress = $this->user->userAddresses()
                                    ->where('is_main_address', 1)
                                    ->first()->id; 
    }

    public function render()
    {
        return view('livewire.users.users-edit');
    }

    public function update()
    {
        $phone = preg_replace( '/^(09)(\d+)/', '639$2', $this->form['phone']);

        $this->form['phone'] = $phone;

        $this->validate();

        $this->user->update([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
        ]);

        $this->emitUp('refreshParent');

        session()->flash('success', 'User has been updated successfully!');
    }

    public function closeEditModal()
    {
        $this->dispatchBrowserEvent('editModalDisplayNone');
        
        $this->emitUp('closeEditModal');
    }
}
