<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

use Yajra\Address\Entities\Region;
use Yajra\Address\Entities\Province;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Barangay;

class ProfileCreateAddress extends Component
{
    public $form = [
        'region' => '',
        'province' => '',
        'city' => '',
        'barangay' => '',
        'home_address' => '',
        'is_main_address' => 1
    ];
    public $provinces = [];
    public $cities = [];
    public $barangays = [];
    public $selectedRegion = "";
    public $selectedProvince = "";
    public $selectedCity = "";
    public $selectedBarangay = "";

    protected $rules = [
        'form.region' => 'required|string|exists:regions,name',
        'form.province' => 'required|string|exists:provinces,name',
        'form.city' => 'required|string|exists:cities,name',
        'form.barangay' => 'required|string|exists:barangays,name',
        'form.home_address' => 'required|string|max:100',
        'form.is_main_address' => 'required|boolean',
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
        $this->regions = Region::get(['name', 'region_id'])->toArray();
    }

    public function render()
    {
        return view('livewire.profile.profile-create-address');
    }

    public function storeAddress()
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

        if($this->form['is_main_address'] == 1) {
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

        $this->reset(['form', 'selectedRegion', 'selectedProvince', 'selectedCity', 'selectedBarangay', 'provinces', 'cities', 'barangays']);
        
        $this->emitUp('mountProfileIndex');

        session()->flash('success', 'Address has been created successfully!'); 
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

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');

        $this->emitUp('closeCreateModal');
    }

    public function updatedSelectedRegion()
    {
        $this->provinces = $this->province_list->toArray();
        $this->selectedProvince = ""; 
        $this->selectedCity = "";
        $this->selectedBarangay = "";
        $this->form['home_address'] = "";
    }

    public function updatedSelectedProvince($province)
    {
        if(!empty($province)) {
            $this->cities = $this->city_list->toArray();
        }

        $this->selectedCity = "";
        $this->selectedBarangay = "";
        $this->form['home_address'] = "";
    }

    public function updatedSelectedCity($city)
    {
        if(!empty($city)) {
            $this->barangays = $this->barangay_list->toArray();
        }

        $this->selectedBarangay = "";
        $this->form['home_address'] = "";
    }
}
