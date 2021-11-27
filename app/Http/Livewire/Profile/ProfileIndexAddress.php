<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserAddress;
use Livewire\Component;

class ProfileIndexAddress extends Component
{
    // public $userAddresses;
    public $selectedAddress;
    public $createModal = false;
    public $region;
    public $mountAddress;

    public $form;

    protected $rules = [
        'form.region' => 'required|string',
        'form.province' => 'required|string',
        'form.city' => 'required|string',
        'form.barangay' => 'required|string',
        'form.home_address' => 'required|string',
    ];

    protected $validationAttributes = [
        'form.region' => 'region',
        'form.province' => 'province',
        'form.city' => 'city',
        'form.barangay' => 'barangay',
        'form.home_address' => 'home address',
    ];

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeCreateModal',
        'latestAddress',
    ];

    public function mount()
    {         
        $this->selectedAddress = auth()->user()->userAddresses()
                                    ->where('is_main_address', 1)
                                    ->first()->id; 

        // dd($this->form['home_address']);
    }

    public function render()
    {
        $userAddress = $this->user_address->first();

        $userAddresses = auth()->user()->userAddresses()
                                ->get()->pluck('id')->toArray(); 

        $this->dispatchBrowserEvent('loadRegions');

        return view('livewire.profile.profile-index-address', compact('userAddress', 'userAddresses'));
    }

    public function getUserAddressProperty()
    {
        return UserAddress::where('id', $this->selectedAddress);
    }

    public function setAsDefault()
    {
        auth()->user()->userAddresses()
            ->where('is_main_address', 1)
            ->update(['is_main_address' => 0]);

        $this->user_address->update(['is_main_address' => 1]);

        // $this->mount();

        // $this->emit('refreshParent');

        // $this->user_address->first()->refresh();

        $this->mount();

        session()->flash('success', 'Address has been successfully set to default!');
    }

    public function latestAddress()
    {
        $this->selectedAddress = auth()->user()->userAddresses()
            ->latest()->first()->id; 
    }

    public function updateAddress($formData)
    {
        $this->form = [
            'region' => $formData['region'],
            'province' => $formData['province'],
            'city' => $formData['city'],
            'barangay' => $formData['barangay'],
            'home_address' => $formData['home_address'],
        ];

        $this->validate();

        $this->user_address->update([
            'region' => $this->form['region'],
            'province' => $this->form['province'],
            'city' => $this->form['city'],
            'barangay' => $this->form['barangay'],
            'home_address' => $this->form['home_address'],
        ]);

        $this->render();

        session()->flash('success', 'Address has been successfully updated!');     
    }

    public function openCreateModal()
    {
        $this->createModal = true;
    }

    public function closeCreateModal()
    {
        $this->createModal = false;
    }
}
