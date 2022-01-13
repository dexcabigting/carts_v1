<div class="p-5">
    <x-success-fail-message class="mb-4" />
    <x-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="storeAddress">
        @csrf

        <!-- Address -->
        <div class="block md:flex flex-row">
            <div class="mt-4 ">
                <x-label :value="__('Region')" />
                <select wire:model="selectedRegion" class="text-black rounded-lg lg:pr-16 pr-4 w-full">
                    <option value="" selected>
                        Select Region
                    </option>
                    @foreach($regions as $region)
                        <option wire:key="{{ $loop->index }}-region" value="{{ $region['region_id'] }}">
                            {{ $region['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if(!empty($selectedRegion))
                <div class="mt-4 md:ml-4">
                    <x-label :value="__('Province')" />
                    <select wire:model="selectedProvince" class="text-black rounded-lg md:pr-20 w-full md:w-auto">
                       <option value="" selected>
                            Select Province 
                        </option>
                        @foreach($provinces as $province)
                            <option wire:key="{{ $loop->index }}-province" value="{{ $province['province_id'] }}">
                                {{ $province['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
        
        @if(!empty($selectedProvince))
            <div class="mt-4">
                <x-label :value="__('City')" />
                <select wire:model="selectedCity" class="text-black rounded-lg w-full">
                    <option value="" selected>
                        Select City 
                    </option>
                    @foreach($cities as $city)
                    <option wire:key="{{ $loop->index }}-city" value="{{ $city['city_id'] }}">
                        {{ $city['name'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        @endif

        @if(!empty($selectedCity) && !empty($barangays))
            <div class="mt-4">
                <x-label :value="__('Barangay')"  />
                <select wire:model="selectedBarangay" class="text-black rounded-lg w-full">
                    <option value="" selected>
                        Select Barangay
                    </option>
                    @foreach($barangays as $barangay)
                        <option wire:key="{{ $loop->index }}-barangay" value="{{ $barangay['id'] }}">
                            {{ $barangay['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        @elseif(!empty($selectedCity) && empty($barangays))
            <div class="mt-4">
                <x-label value="This city has no barangays." />
            </div>

            <div wire:key="home_address-1" class="mt-4">
                <x-label class="text-xl mb-4 text-white" :value="__('Home Address')" />
                <x-input wire:model="form.home_address" class="block mt-1 w-full text-black" type="text" placeholder="ex. Street/Apartment no." />
            </div>
        @endif

        @if(!empty($selectedRegion) && !empty($selectedProvince) && !empty($selectedCity) && !empty($selectedBarangay))
            <div wire:key="home_address-2" class="mt-4">
                <x-label class="text-xl mb-4 text-white" :value="__('Home Address')" />
                <x-input wire:model="form.home_address" class="block mt-1 w-full text-black" type="text" placeholder="ex. Street/Apartment no." />
            </div>
        @endif

        <div class="mt-4 text-white">
            <x-label :value="__('Set as Default')" />
            <div>
                <input wire:model="form.is_main_address" type="radio" value="1"/>
                <label>Yes</label>
            </div>
            <div>
                <input wire:model="form.is_main_address" type="radio" value="0"/>
                <label>No</label>
            </div>
        </div>

        <div class="flex justify-center items-center gap-5 mt-4"> 
            <div wire:key="1">
                <x-button class="hover:bg-purple-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet">
                    {{ __('Save') }}
                </x-button>
            </div>
            <div wire:key="2">
                <x-button wire:click.prevent="closeCreateModal()" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </form>
</div>    


    
