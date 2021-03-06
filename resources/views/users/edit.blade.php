<div class="max-w-7xl p-5">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex flex-col gap-5 bg-custom-blacki justify-center items-center">
        <div>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('User Credentials') }} 
            </h2>
        </div>

        <form class="bg-custom-blacki" wire:submit.prevent="update">
            @csrf
            <div class="flex flex-row gap-5">
                <div class="flex flex-col gap-5">
                    <div class="text-gray-900">
                        <x-label  for="name" :value="__('Name')"/>
                        <x-input wire:model.defer="form.name" id="name" class="block mt-1 w-full text-black" type="text" name="name" autofocus required />
                    </div>

                    <div class="">
                        <x-label for="email" :value="__('Email')" />
                        <x-input wire:model.defer="form.email" id="email" class="block mt-1 w-full text-black" type="email" name="email" required />
                    </div>

                    <div class="">
                        <x-label for="phone" :value="__('Phone')" />
                        <x-input wire:model.defer="form.phone" id="phone" class="block mt-1 w-full text-black" type="text" name="phone" required />
                    </div>

                    <div class="flex flex-row gap-5">
                        <div class="w-1/2">
                            <x-label :value="__('Role')" />
                            @foreach($roles as $role)
                                <div wire:key="{{ $loop->index }}-role">
                                    <input wire:model="form.role_id" type="radio" value="{{ $role['id'] }}" required/>
                                    <span>{{ $role['role'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        @if(empty($user->email_verified_at))
                            <div class="w-1/2">
                                <x-button wire:click.prevent="verifyEmail()" type="button" class="bg-red-500 text-gray-100 text-xl font-bold px-4 py-2">
                                    {{ __('Verify Email') }}
                                </x-button>
                            </div>
                        @endif
                    </div>  
                </div>

                <div class="">
                    <div class="text-sm font-medium text-gray-900">
                        <select wire:model="selectedAddress">
                            @foreach($userAddresses as $index => $address)
                                <option wire:key="{{ $loop->index }}-address" value="{{ $address }}">
                                    Address {{ $index + 1 }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="block md:flex flex-row">
                        <div class="">
                            <x-label :value="__('Region')" />
                            <select wire:model="selectedRegion" class="text-black rounded-lg lg:pr-16 pr-4 w-full">
                                <option value="" selected>Select Region</option>
                                @foreach($regions as $region)
                                    <option wire:key="{{ $loop->index }}-region" value="{{ $region['region_id'] }}">
                                        {{ $region['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if(!empty($selectedRegion))
                            <div class="md:ml-4">
                                <x-label :value="__('Province')" />
                                <select wire:model="selectedProvince" class="text-black rounded-lg md:pr-20 w-full md:w-auto" id="create_province">
                                    <option value="" selected>Select Province</option>
                                    @foreach($provinces as $province)
                                        <option wire:key="{{ $loop->index }}-province" value="{{ $province['province_id'] }}" @if($province['province_id'] == '') selected="selected" @endif>
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
                                <option value="" selected>Select City</option>
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
                                <option value="" selected>Select Barangay</option>
                                @foreach($barangays as $barangay)
                                    <option wire:key="{{ $loop->index }}-barangay" value="{{ $barangay['id'] }}">
                                        {{ $barangay['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @elseif(!empty($selectedRegion) && !empty($selectedProvince) && !empty($selectedCity) && empty($barangays))
                        <div class="mt-4">
                            <x-label value="This city has no barangays." />
                        </div>
                    @endif      

                    @if(!empty($selectedRegion) && !empty($selectedProvince) && !empty($selectedCity))
                        <div wire:key="home_address-1" class="mt-4">
                            <x-label class="text-xl mb-4 text-white" :value="__('Home Address')" />
                            <x-input wire:model="form.home_address" class="block mt-1 w-full text-black" type="text" placeholder="ex. Street/Apartment no." />
                        </div>
                    @endif 

                    @if(!$isDefaultAddress)
                    <div class="mt-4">
                        <x-button wire:click.prevent="setAsDefault()" type="button" class="bg-red-500 text-gray-100 text-xl font-bold px-4 py-2">
                            {{ __('Set as Default') }}
                        </x-button>
                    </div>
                    @endif

                </div>
            </div>

            <div class="mt-4 flex gap-5 justify-center">
                <div>
                    <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet">
                        {{ __('Update User') }}
                    </x-button>
                </div>
                
                <div>
                    <x-button wire:click.prevent="closeEditModal()" type="button" class="bg-red-500 text-gray-100 text-xl font-bold px-4 py-2">
                        {{ __('Close') }}
                    </x-button>
                </div>  
            </div>
        </form>
    </div>
</div>

    
