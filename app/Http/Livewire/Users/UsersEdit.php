<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\Role;

use Yajra\Address\Entities\Region;
use Yajra\Address\Entities\Province;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Barangay;

use App\Service\Twilio\PhoneNumberLookupService;

use App\Rules\PhoneNumber;

class UsersEdit extends Component
{
    public $user;
    public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'role_id' => '',
        'verify_email' => '',
        'region' => '',
        'province' => '',
        'city' => '',
        'barangay' => '',
        'home_address' => '',
        'is_main_address' => ''
    ];
    public $selectedAddress;
    public $roles = [];
    public $yesOrNo = [];
    public $regions = [];
    public $selectedRegion = '';
    public $selectedProvince = '';
    public $selectedCity = '';
    public $selectedBarangay = '';

    protected function rules()
    {   
        $service = app()->make(PhoneNumberLookupService::class);
        
        return [
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'form.phone' => ['required', 'string', 'unique:users,phone,' . $this->user->id, new PhoneNumber($service)],
            'form.role_id' => ['required', 'exists:roles,id'],
            'form.verify_email' => ['required', 'in:Yes,No'],
            'form.region' => ['required', 'string', 'exists:regions,name'],
            'form.province' => ['required', 'string', 'exists:provinces,name'],
            'form.city' => ['required', 'string', 'exists:cities,name'],
            'form.barangay' => ['required', 'string', 'exists:barangays,name'],
            'form.home_address' => ['required', 'string'],
            'form.is_main_address' => ['required', 'string']
        ];
    }

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email address',
        'form.phone' => 'phone number',
        'form.role_id' => 'role_id',
        'form.verify_email' => 'verify email',
        'form.region' => 'region',
        'form.province' => 'province',
        'form.city' => 'city',
        'form.barangay' => 'barangay',
        'form.home_address' => 'home address',
        'form.is_main_address' => 'default'
    ];

    public function mount(User $id)
    {
        $this->form = [
            'name' => $id->name,
            'email' => $id->email,
            'phone' => $id->phone,
            'role_id' => $id->role_id,
        ];

        $this->user = $id;

        $this->selectedAddress = $this->user->userAddresses()
                                    ->where('is_main_address', 1)
                                    ->first()->id; 

        $this->roles = Role::get(['id', 'role'])->toArray();

        $this->yesOrNo = ['Yes', 'No'];

        $this->regions = Region::get(['name', 'region_id'])->toArray();
    }

    public function render()
    {
        $userAddress = $this->user_address->first();

        $userAddresses = $this->user->userAddresses()
                                ->get()->pluck('id')->toArray();

        $this->selectedRegion = Region::where('name', $userAddress->region)->first()->region_id;
        $this->selectedProvince = Province::where('name', $userAddress->province)->first()->province_id;
        $this->selectedCity = City::where('name', $userAddress->city)->first()->city_id;
        $this->selectedBarangay = Barangay::where('name', $userAddress->barangay)->first()->id;

        $provinces = $this->provinces->toArray();
        $cities = $this->cities->toArray();
        $barangays = $this->barangays->toArray();

        return view('livewire.users.users-edit', compact('userAddress', 'userAddresses', 'provinces', 'cities', 'barangays'));
    }

    public function getUserAddressProperty()
    {
        return UserAddress::where('id', $this->selectedAddress);
    }

    public function getProvincesProperty()
    {
        return Province::where('region_id', $this->selectedRegion)
            ->get(['name', 'region_id', 'province_id']);
    }

    public function getCitiesProperty()
    {
        return City::where('region_id', $this->selectedRegion)
            ->where('province_id', $this->selectedProvince)
            ->get(['name', 'region_id', 'province_id', 'city_id']);
    }

    public function getBarangaysProperty()
    {
        return Barangay::where('region_id', $this->selectedRegion)
            ->where('province_id', $this->selectedProvince)
            ->where('city_id', $this->selectedCity)
            ->get(['id', 'name']);
    }

    public function getRegionProperty()
    {
        return Region::where('region_id', $this->selectedRegion)->first('name');
    }

    public function getProvinceProperty()
    {
        return Province::where('province_id', $this->selectedProvince)->first('name');
    }

    public function getCityProperty()
    {
        return City::where('city_id', $this->selectedCity)->first('name');
    }

    public function getBarangayProperty()
    {
        return Barangay::where('id', $this->selectedBarangay)->first('name');
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
