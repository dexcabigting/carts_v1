<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserAddress;
use Livewire\Component;

class ProfileIndexAddress extends Component
{
    public $userAddresses;
    public $selectedAddress;
    public $createModal = false;
    public $region;
    public $mountAddress;
    public $form = [
        'region' => '',
        'province' => '',
        'city' => '',
        'barangay' => '',
        'home_address' => '',
    ];

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeCreateModal',
    ];

    public function mount()
    {
        $this->selectedAddress = auth()->user()->userAddresses()
                                    ->where('is_main_address', 1)
                                    ->first()->id;

        $this->mountAddress = auth()->user()->userAddresses()
            ->where('id', $this->selectedAddress)
            ->first();

        $this->userAddresses = auth()->user()->userAddresses()
                                ->get()->pluck('id')->toArray();

        // dd($this->form['home_address']);
    }

    public function render()
    {
        $this->dispatchBrowserEvent('loadRegions');

        $userAddress = $this->user_address->first();

        $this->form = [
            'region' => $userAddress->region,
            'province' => $userAddress->province,
            'city' => $userAddress->city,
            'barangay' => $userAddress->barangay,
            'home_address' => $this->form['home_address'] == "" ? $userAddress->home_address : $this->form['home_address'],
        ];

        return view('livewire.profile.profile-index-address', compact('userAddress'));
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

        $this->user_address->first()->refresh();

        session()->flash('success', 'Address has been successfully set to default!');
    }

    public function updatedSelectedAddress()
    {
        // $this->mount();
    }

    public function updateAddress()
    {
        dd($this->form['region']);
    }

    public function openCreateModal()
    {
        $this->createModal = true;

        // $this->dispatchBrowserEvent('loadRegions');
    }

    public function closeCreateModal()
    {
        $this->createModal = false;

        // $this->dispatchBrowserEvent('loadRegions');
    }
}
