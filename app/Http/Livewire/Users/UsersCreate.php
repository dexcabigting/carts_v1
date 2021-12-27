<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use App\Models\User;
use App\Models\Role;

use Yajra\Address\Entities\Region;
use Yajra\Address\Entities\Province;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Barangay;

use Exception;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Service\Twilio\PhoneNumberLookupService;

use App\Rules\PhoneNumber;

class UsersCreate extends Component
{
    public $form = [
        'name' => "",
        'email' => "",
        'phone' => "",
        'password' => "",
        'password_confirmation' => "",
        'role_id' => "",
        'verify_email' => "",
        'region' => "",
        'province' => "",
        'city' => "",
        'barangay' => "",
        'home_address' => "",
    ];
    public $roles = [];
    public $yesOrNo = [];
    public $regions = [];
    public $provinces = [];
    public $cities = [];
    public $barangays = [];
    public $selectedRegion = "";
    public $selectedProvince = "";
    public $selectedCity = "";
    public $selectedBarangay = "";

    protected function rules()
    {
        $service = app()->make(PhoneNumberLookupService::class);
        
        return [
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'form.phone' => ['required', 'string', 'unique:users,phone', new PhoneNumber($service)],
            'form.password' => ['required', 'confirmed', Rules\Password::defaults()],
            'form.role_id' => ['required', 'exists:roles,id'],
            'form.verify_email' => ['required', 'in:Yes,No'],
            'form.region' => ['required', 'string', 'exists:regions,name'],
            'form.province' => ['required', 'string', 'exists:provinces,name'],
            'form.city' => ['required', 'string', 'exists:cities,name'],
            'form.barangay' => ['required', 'string', 'exists:barangays,name'],
            'form.home_address' => ['required', 'string']
        ];
    }
    
    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email address',
        'form.phone' => 'phone number',
        'form.password' => 'password',
        'form.password_confirmation' => 'confirm password',
        'form.role_id' => 'role_id',
        'form.verify_email' => 'verify email',
        'form.region' => 'region',
        'form.province' => 'province',
        'form.city' => 'city',
        'form.barangay' => 'barangay',
        'form.home_address' => 'home address',
    ];

    public function mount()
    {
        $this->roles = Role::get(['id', 'role'])->toArray();

        $this->yesOrNo = ['Yes', 'No'];

        $this->regions = Region::get(['name', 'region_id'])->toArray();
    }

    public function render()
    {
        return view('livewire.users.users-create');
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

    public function store($formData)
    {
        $phone = preg_replace('/^(09)(\d+)/', '639$2', $this->form['phone']);

        $this->form['phone'] = $phone;

        $this->form['region'] = (empty($this->selectedRegion)) ? "" : $this->region->name;
        $this->form['province'] = (empty($this->selectedProvince)) ? "" : $this->province->name;
        $this->form['city'] = (empty($this->selectedCity)) ? "" : $this->city->name;

        if(!empty($this->barangays)) {
            $this->form['barangay'] = (empty($this->selectedBarangay)) ? "" : $this->barangay->name;
        } elseif(empty($this->barangays)) {
            $this->form['barangay'] = (!empty($this->selectedCity) && empty($this->selectedBarangay)) ? 'N/A' : "" ;
        }

        $this->form['verify_email'] = $formData['verify_email'];

        $this->form['role_id'] = $formData['role_id'];

        $this->validate();

        try {
            DB::transaction(function() {
                $user = User::create([
                    'name' => $this->form['name'],
                    'email' => $this->form['email'],
                    'phone' => $this->form['phone'],
                    'password' => Hash::make($this->form['password']),
                    'role_id' => $this->form['role_id'],
                    'email_verified_at' => ($this->form['verify_email'] == "Yes") ? now() : null
                ]);

                $user->userAddresses()->create([
                    'region' => $this->form['region'],
                    'province' => $this->form['province'],
                    'city' => $this->form['city'],
                    'barangay' => $this->form['barangay'],
                    'home_address' => $this->form['home_address'],
                    'is_main_address' => 1,
                ]);

                $this->reset(['form', 'selectedRegion', 'selectedProvince', 'selectedCity', 'selectedBarangay', 'provinces', 'cities', 'barangays']);

                $this->emitUp('refreshParent');

                session()->flash('success', 'User has been successfully created!'); 
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
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
