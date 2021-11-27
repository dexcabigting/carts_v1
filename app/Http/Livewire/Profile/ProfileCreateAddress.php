<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\UserAddress;

class ProfileCreateAddress extends Component
{
    public $form;

    protected $rules = [
        'form.region' => 'required|string',
        'form.province' => 'required|string',
        'form.city' => 'required|string',
        'form.barangay' => 'required|string',
        'form.home_address' => 'required|string',
        'form.is_main_address' => 'required|string',
    ];

    protected $validationAttributes = [
        'form.region' => 'region',
        'form.province' => 'province',
        'form.city' => 'city',
        'form.barangay' => 'barangay',
        'form.home_address' => 'home address',
        'form.is_main_address' => 'default',
    ];

    public function mount()
    {
        $this->form = [];
    }

    public function render()
    {
        return view('livewire.profile.profile-create-address');
    }

    public function storeAddress($formData)
    {
        $this->form = [
            'region' => $formData['create_region'],
            'province' => $formData['create_province'],
            'city' => $formData['create_city'],
            'barangay' => $formData['create_barangay'],
            'home_address' => $formData['create_home_address'],
            'is_main_address' => $formData['is_main_address'],
        ];

        $this->validate();

        if($this->form['is_main_address'] == "1") {
            auth()->user()->userAddresses()
                ->where('is_main_address', 1)
                ->update(['is_main_address' => 0]);
        }

        auth()->user()->userAddresses()->create([
            'region' => $this->form['region'],
            'province' => $this->form['province'],
            'city' => $this->form['city'],
            'barangay' => $this->form['barangay'],
            'home_address' => $this->form['home_address'],
            'is_main_address' => $this->form['is_main_address'],
        ]);

        $this->clearFormFields();

        $UserAddresses = UserAddress::where('user_id', auth()->user()->id)
            ->where('is_main_address', 1)->first()->refresh();

        $this->emit('refreshParent');

        session()->flash('success', 'Address has been created successfully!'); 
    }

    public function clearFormFields()
    {
        $this->form = [];
    }

    public function closeCreateModal()
    {
        $this->emitUp('refreshParent');

        $this->dispatchBrowserEvent('createModalDisplayNone');

        $this->emitUp('closeCreateModal');
    }
}
