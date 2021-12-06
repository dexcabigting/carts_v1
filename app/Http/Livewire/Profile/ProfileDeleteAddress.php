<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\UserAddress;

class ProfileDeleteAddress extends Component
{
    public $promptDelete = 1;
    public $promptDeleted = 0;
    public $address;
    public $isMainAddress;

    public function mount(UserAddress $id)
    {
        $this->address = $id;

        if($id->is_main_address == 1) {
            $this->isMainAddress = 1;
        } else {
            $this->isMainAddress = 0;
        }
    }

    public function render()
    {
        return view('livewire.profile.profile-delete-address');
    }

    public function deleteAddress()
    {
        $this->address->delete();

        UserAddress::where('user_id', auth()->user()->id)
            ->where('is_main_address', 1)->first()->refresh();

        $this->emitUp('mount');

        session()->flash('success', 'Address has been successfully deleted!');

        $this->promptDelete = 0;
        $this->promptDeleted = 1;
    }

    public function closeDeleteModal()
    {
        $this->dispatchBrowserEvent('deleteModalDisplayNone');

        $this->emitUp('closeDeleteModal');
    }
}
