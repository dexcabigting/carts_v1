<div>
    <x-auth-card>
        <div class="px-12">
            <section class="w-full flex justify-center items-center my-24 flex-col">
                <h1 class="font-semibold  text-7xl md:text-9xl text-custom-blacki my-4">REGISTER</h1>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="w-full max-w-lg" wire:submit.prevent="store">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-label class="text-xl text-purple-100" :value="__('Name')" />
                        <x-input wire:model.defer="form.name" class="block mt-1 w-full" type="text" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label class="text-xl text-purple-100" :value="__('Email')" />
                        <x-input wire:model.defer="form.email" class="block mt-1 w-full" type="email" :value="old('email')" required />
                    </div>

                    <!-- Phone -->
                    <div class="mt-4">
                        <x-label class="text-xl text-purple-100" :value="__('Phone')" />
                        <x-input wire:model.defer="form.phone" class="block mt-1 w-full" type="tel" :value="old('phone')" required />
                    </div>

                    <!-- Address -->
                    <div class="mt-4">
                        <x-label  class="text-xl text-purple-100" :value="__('Region')" />
                        <select wire:model="selectedRegion" class="w-full rounded-lg">
                            <option value="" selected>
                                Region
                            </option>
                            @foreach($regions as $region)
                                <option value="{{ $region['region_id'] }}">
                                    {{ $region['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if(!empty($selectedRegion))
                    <div class="mt-4">
                        <x-label class="text-xl text-purple-100" :value="__('Province')" />
                        <select wire:model="selectedProvince" class="w-full rounded-lg">
                            <option value="" selected>
                                Province
                            </option>
                            @foreach($provinces as $province)
                                <option value="{{ $province['province_id'] }}">
                                    {{ $province['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    @if(!empty($selectedProvince))
                    <div class="mt-4">
                        <x-label class="text-xl text-purple-100" :value="__('City')" />
                        <select wire:model="selectedCity" class="w-full rounded-lg" >
                            <option value="" selected>
                                City
                            </option>
                            @foreach($cities as $city)
                            <option value="{{ $city['city_id'] }}">
                                {{ $city['name'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    @if(!empty($selectedCity) && !empty($barangays))
                    <div class="mt-4">
                        <x-label class="text-xl text-purple-100" :value="__('Barangay')" />
                        <select wire:model="selectedBarangay" class="w-full rounded-lg">
                            <option value="" selected>
                                Barangay
                            </option>
                            @foreach($barangays as $barangay)
                                <option value="{{ $barangay['id'] }}">
                                    {{ $barangay['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @elseif(!empty($selectedCity) && empty($barangays))
                    <div class="mt-4">
                        <x-label value="This city has no barangays." />
                    </div>
                    @endif

                    @if(!empty($selectedRegion) && !empty($selectedProvince) && !empty($selectedCity) && (!empty($selectedBarangay) || $this->form['barangay'] == "N/A"))
                    <div class="mt-4">
                        <x-label class="text-xl text-purple-100" :value="__('Home Address')" />
                        <x-input wire:model.defer="form.home_address" class="block mt-1 w-full" type="text" :value="old('home_address')" placeholder="ex. Street or Apartment no." required />
                    </div>
                    @endif
                    
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label class="text-xl text-purple-100" :value="__('Password')" />
                        <x-input wire:model.defer="form.password" class="block mt-1 w-full" type="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label class="text-xl text-purple-100" :value="__('Confirm Password')" />
                        <x-input wire:model.defer="form.password_confirmation" class="block mt-1 w-full" type="password" required />
                    </div>

                    <div class="flex items-center flex-col justify-center mt-4">
                        <div>
                            <x-button class="md:mt-4 mt-12 uppercase hover:bg-purple-900 hover:text-purple-100 text-3xl font-semibold text-white px-32 md:px-44 py-6 my-6 w-full bg-custom-violet">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                        <div>
                            <a class="underline text-xl text-gray-600 hover:text-purple-200" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </x-auth-card>
</div>

    
