<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\UserAddress;

class ProfileCreateAddress extends Component
{
    public $form = [
        'region' => '',
        'province' => '',
        'city' => '',
        'barangay' => '',
        'home_address' => '',
        'is_main_address' => '',
    ];

    protected $rules = [
        'form.region' => 'required|string',
        'form.province' => 'required|string',
        'form.city' => 'required|string',
        'form.barangay' => 'required|string',
        'form.home_address' => 'required|string',
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
        
    }

    public function render()
    {
        return view('livewire.profile.profile-create-address');
    }

    public function store()
    {
        $this->validate();

        if($this->form['is_main_address'] == 1) {
            auth()->user()->userAddresses()
                ->where('is_main_address', 1)
                ->update(['is_main_address' => 0]);
        }

        auth()->userAddresses()->create([
            'region' => $this->form['region'],
            'province' => $this->form['province'],
            'city' => $this->form['city'],
            'barangay' => $this->form['barangay'],
            'home_address' => $this->form['home_address'],
            'is_main_address' => $this->form['is_main_address'],
        ]);

        $this->clearFormFields();

        $this->emitUp('refreshParent');

        session()->flash('success', 'Address has been created successfully!'); 
    }

    public function clearFormFields()
    {
        $this->form = [
            'region' => '',
            'province' => '',
            'city' => '',
            'barangay' => '',
            'home_address' => '',
            'is_main_address' => '',
        ];
    }

    public function closeCreateModal()
    {
        $this->dispatchBrowserEvent('createModalDisplayNone');

        $this->emitUp('closeCreateModal');
    }
}
