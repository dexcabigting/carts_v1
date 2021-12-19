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
use Illuminate\Support\Arr;

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
    public $address = null;
    public $isDefaultAddress = true;
    public $userAddresses = [];
    public $selectedAddress;
    public $roles = [];
    public $yesOrNo = [];
    public $regions = [];
    public $provinces = [];
    public $cities = [];
    public $barangays = [];
    public $selectedRegion = null;
    public $selectedProvince = null;
    public $selectedCity = null;
    public $selectedBarangay = null;

    protected function rules()
    {   
        $service = app()->make(PhoneNumberLookupService::class);
        
        return [
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'form.phone' => ['required', 'string', 'unique:users,phone,' . $this->user->id, new PhoneNumber($service)],
            'form.role_id' => ['required', 'exists:roles,id'],
            'form.region' => ['required', 'string', 'exists:regions,name'],
            'form.province' => ['required', 'string', 'exists:provinces,name'],
            'form.city' => ['required', 'string', 'exists:cities,name'],
            'form.barangay' => ['required', 'string', 'exists:barangays,name'],
            'form.home_address' => ['required', 'string', 'max:100'],
        ];
    }

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email address',
        'form.phone' => 'phone number',
        'form.role_id' => 'role_id',
        'form.region' => 'region',
        'form.province' => 'province',
        'form.city' => 'city',
        'form.barangay' => 'barangay',
        'form.home_address' => 'home address',
    ];

    public function mount(User $id, $selectedAddress = null)
    {
        $this->user = $id;

        $this->userAddresses = $this->user->userAddresses()
                                ->get()->pluck('id')->toArray();

        $this->selectedAddress = $this->user->userAddresses()
                                    ->where('is_main_address', (is_null($selectedAddress)) ? 1 : $selectedAddress)
                                    ->first()->id; 
        
        $this->address = $this->user->userAddresses()
                                    ->where('is_main_address', 1)
                                    ->first();

        $this->isDefaultAddress = $this->address->is_main_address;

        $this->selectedRegion = $this->regionId($this->address->region);
        $this->selectedProvince = $this->provinceId($this->address->province);
        $this->selectedCity = $this->cityId($this->address->city);
        $this->selectedBarangay = $this->barangayId($this->address->barangay);

        $this->provinces = $this->province_list->toArray();
        $this->cities = $this->city_list->toArray();
        $this->barangays = $this->barangay_list->toArray();
        
        $this->roles = Role::get(['id', 'role'])->toArray();

        $this->yesOrNo = ['Yes', 'No'];

        $this->regions = Region::get(['name', 'region_id'])->toArray();

        $this->form = [
            'name' => $id->name,
            'email' => $id->email,
            'phone' => $id->phone,
            'role_id' => $id->role_id,
            'home_address' => $this->address->home_address,
        ];
    }

    public function updatedSelectedAddress()
    {
        $this->address  = $this->user_address->first();

        $this->isDefaultAddress = $this->address->is_main_address;

        $this->selectedRegion = $this->regionId($this->address->region);
        $this->selectedProvince = $this->provinceId($this->address->province);
        $this->selectedCity = $this->cityId($this->address->city);
        $this->selectedBarangay = $this->barangayId($this->address->barangay);

        $this->provinces = $this->province_list->toArray();
        $this->cities = $this->city_list->toArray();
        $this->barangays = $this->barangay_list->toArray();

        $this->form['home_address'] = $this->address->home_address;
    }

    public function regionId($name) {
        return Region::where('name', $name)->first()->region_id;
    }

    public function provinceId($name) {
        return Province::where('name', $name)->first()->province_id;
    }

    public function cityId($name) {
        return City::where('name', $name)->first()->city_id;
    }

    public function barangayId($name) {
        return Barangay::where('name', $name)->first()->id;
    }

    public function render()
    {
        return view('livewire.users.users-edit');
    }

    public function getUserAddressProperty()
    {
        return UserAddress::where('id', $this->selectedAddress);
    }

    public function getProvinceListProperty()
    {
        return Province::where('region_id', $this->selectedRegion)
            ->get(['name', 'region_id', 'province_id']);
    }

    public function getCityListProperty()
    {
        return City::where('region_id', $this->selectedRegion)
            ->where('province_id', $this->selectedProvince)
            ->get(['name', 'region_id', 'province_id', 'city_id']);
    }

    public function getBarangayListProperty()
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

        $this->form['region'] = (empty($this->selectedRegion)) ? "" : $this->region->name;
        $this->form['province'] = (empty($this->selectedProvince)) ? "" : $this->province->name;
        $this->form['city'] = (empty($this->selectedCity)) ? "" : $this->city->name;

        if(!empty($this->barangays)) {
            $this->form['barangay'] = (empty($this->selectedBarangay)) ? "" : $this->barangay->name;
        } elseif(empty($this->barangays)) {
            $this->form['barangay'] = (!empty($this->selectedCity) && empty($this->selectedBarangay)) ? 'N/A' : "" ;
        }
        
        $this->validate();

        $this->user->update([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
            'role_id' => $this->form['role_id']
        ]); 
    
        $this->user_address->update([
            'region' => $this->form['region'],
            'province' => $this->form['province'],
            'city' => $this->form['city'],
            'barangay' => $this->form['barangay'],
            'home_address' => $this->form['home_address'],
        ]);

        // $this->mount($this->user, $this->selectedAddress);

        $this->emitUp('refreshParent');

        if($this->form['role_id'] == 1) {
            $this->emitUp('unsetCheckedUsers', [$this->user->id]);
        }

        session()->flash('success', 'User has been updated successfully!');
    }

    public function closeEditModal()
    {
        $this->dispatchBrowserEvent('editModalDisplayNone');
        
        $this->emitUp('closeEditModal');
    }

    public function updatedSelectedRegion()
    {
        $this->provinces = $this->province_list->toArray();
        $this->selectedProvince = ""; 
        $this->selectedCity = "";
        $this->selectedBarangay = "";
    }

    public function updatedSelectedProvince($province)
    {
        if(!empty($province)) {
            $this->cities = $this->city_list->toArray();
        }

        $this->selectedCity = "";
        $this->selectedBarangay = "";
    }

    public function updatedSelectedCity($city)
    {
        if(!empty($city)) {
            $this->barangays = $this->barangay_list->toArray();
        }

        $this->selectedBarangay = "";
    }

    public function setAsDefault()
    {
        $this->user->userAddresses()
            ->where('is_main_address', 1)
            ->update(['is_main_address' => 0]);

        $this->user_address->update(['is_main_address' => 1]);

        $this->mount($this->user);

        session()->flash('success', 'Address has been successfully set to default!');
    }

    public function verifyEmail()
    {
        $this->user->update(['email_verified_at' => now()]);

        $this->mount($this->user);

        $this->emitUp('refreshParent');

        session()->flash('success', 'Email has been successfully verified!');
    }
}
