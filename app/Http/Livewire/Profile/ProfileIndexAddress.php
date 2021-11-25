<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserAddress;
use Livewire\Component;

class ProfileIndexAddress extends Component
{
    public $userAddresses;
    public $selectedAddress;
    public $createModal = false;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount()
    {
        $this->selectedAddress = auth()->user()->userAddresses()
                                    ->where('is_main_address', 1)
                                    ->first()->id;

        $this->userAddresses = auth()->user()->userAddresses()
                                ->get()->pluck('id')->toArray();
    }

    public function render()
    {
        $userAddress = $this->user_address->first();

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

        $this->mount();

        session()->flash('success', 'Address has been successfully set to default!');
    }

    public function updatedSelectedAddress()
    {
        $this->dispatchBrowserEvent('loadRegions');
    }

    public function openCreateModal()
    {
        $this->createModal = true;
    }
}
