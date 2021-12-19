<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserAddress;

use Yajra\Address\Entities\Region;
use Yajra\Address\Entities\Province;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Barangay;

use Livewire\Component;

class ProfileIndexAddress extends Component
{
    public $form = [
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
    public $regions = [];
    public $provinces = [];
    public $cities = [];
    public $barangays = [];
    public $selectedRegion = null;
    public $selectedProvince = null;
    public $selectedCity = null;
    public $selectedBarangay = null;
    public $createModal = false;
    public $deleteModal = false;

    protected $rules = [
        'form.region' => 'required|string|exists:regions,name',
        'form.province' => 'required|string|exists:provinces,name',
        'form.city' => 'required|string|exists:cities,name',
        'form.barangay' => 'required|string|exists:barangays,name',
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
        'closeDeleteModal',
        'latestAddress',
        'mountProfileIndex' => 'mount',
    ];

    public function mount($selectedAddress = null)
    {         
        $this->userAddresses = auth()->user()->userAddresses()
                                ->get()->pluck('id')->toArray();

        // dd(auth()->user()->userAddresses()->get()->toArray());

        $this->selectedAddress = auth()->user()->userAddresses()
                                    ->where('is_main_address', (is_null($selectedAddress)) ? 1 : $selectedAddress)
                                    ->first()->id;

        $this->address = auth()->user()->userAddresses()
                                    ->where('is_main_address', 1)
                                    ->first();

        $this->isDefaultAddress = $this->address->is_main_address;

        $this->selectedRegion = $this->regionId($this->address->region);
        $this->selectedProvince = $this->provinceId($this->address->province);
        $this->selectedCity = $this->cityId($this->address->city);
        $this->selectedBarangay = $this->barangayId($this->address->barangay);

        // dd($this->selectedBarangay, $this->address->barangay);

        $this->provinces = $this->province_list->toArray();
        $this->cities = $this->city_list->toArray();
        $this->barangays = $this->barangay_list->toArray();

        $this->regions = Region::get(['name', 'region_id'])->toArray();
    }

    public function render()
    {
        return view('livewire.profile.profile-index-address');
    }

    public function getUserAddressProperty()
    {
        return UserAddress::where('id', $this->selectedAddress);
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
        return Province::where('name', $name)
                    ->where('region_id', $this->selectedRegion)
                    ->first()->province_id;
    }

    public function cityId($name) {
        return City::where('name', $name)
                    ->where('region_id', $this->selectedRegion)
                    ->where('province_id', $this->selectedProvince)
                    ->first()->city_id;
    }

    public function barangayId($name) {
        $cityId = $this->selectedCity;

        $barangay =  Barangay::where('name', $name)
                    ->where('region_id', $this->selectedRegion)
                    ->where('province_id', $this->selectedProvince)
                    ->when($cityId, function ($query, $cityId) {
                        return $query->where('city_id', $cityId);
                    })
                    ->first();

        return ($barangay == null) ? Barangay::where('name', 'N/A')->first()->id : $barangay->id;
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

    public function setAsDefault()
    {
        auth()->user()->userAddresses()
            ->where('is_main_address', 1)
            ->update(['is_main_address' => 0]);

        $this->user_address->update(['is_main_address' => 1]);

        $this->mount();

        session()->flash('success', 'Address has been successfully set to default!');
    }

    public function updateAddress()
    {
        $this->form['region'] = (empty($this->selectedRegion)) ? "" : $this->region->name;
        $this->form['province'] = (empty($this->selectedProvince)) ? "" : $this->province->name;
        $this->form['city'] = (empty($this->selectedCity)) ? "" : $this->city->name;

        if(!empty($this->barangays)) {
            $this->form['barangay'] = (empty($this->selectedBarangay)) ? "" : $this->barangay->name;
        } elseif(empty($this->barangays)) {
            $this->form['barangay'] = (!empty($this->selectedCity) && empty($this->selectedBarangay)) ? 'N/A' : "" ;
        }

        $this->validate();

        $this->user_address->update([
            'region' => $this->form['region'],
            'province' => $this->form['province'],
            'city' => $this->form['city'],
            'barangay' => $this->form['barangay'],
            'home_address' => $this->form['home_address'],
        ]);

        session()->flash('success', 'Address has been successfully updated!');     
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

    public function openCreateModal()
    {
        $this->createModal = true;
    }

    public function closeCreateModal()
    {
        $this->createModal = false;
    }

     public function openDeleteModal()
    {
        $this->deleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
    }
}
