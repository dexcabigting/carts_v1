<div class="pt-4">
    <x-success-fail-message class="mb-4" />

    <div class="flex flex-col gap-5">
        <div>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Address') }}
            </h2>
        </div>

        <div>
            <x-button class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500" type="button" wire:click="openCreateModal()">
                {{ __('Create Address') }}
            </x-button>
        </div>
        
        
        <div class="text-sm font-medium text-gray-900">
            <select wire:model="selectedAddress">
                @foreach($userAddresses as $index => $address)
                    <option value="{{ $address }}">
                        Address {{ $index + 1 }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>         

     <div class="mt-4">
            @if($userAddress->is_main_address == 1)
                <x-input class="block mt-1 w-1/4" type="text" value="Default Address" disabled/>
            @else
                <div>
                    <x-button class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500" type="button" wire:click="setAsDefault()">
                        {{ __('Set as Default') }}
                    </x-button>
                </div>
            @endif
        </div>
      

    <form wire:submit.prevent="updateAddress">
        @csrf
       
        <div class="mt-4">
            <x-label class="text-xl mb-4 text-white  " for="home_address" :value="__('Home Address: ' . $userAddress->home_address )" />

            <x-input class="block mt-1 w-full" type="text" placeholder="ex. Street Apartment no." wire:model="form.home_address"/>
        </div>

        <div class="text-white">
            {{ $this->form['region'] }}
        </div>

        <!-- Address -->
        <div class="block md:flex fle-row">
            <div class="mt-4 ">
                <x-label for="region" value="Region: {{ $userAddress->region ?? '' }}" />
                <select class="rounded-lg lg:pr-16 pr-4 w-full" id="region">
                    <option selected>
                        Region
                    </option>
                </select>
                <input wire:model="form.region" id="region-text" type="hidden"/>
            </div>

            <div class="mt-4 md:ml-4">
                <x-label for="province" value="Province: {{ Str::ucfirst(Str::lower($userAddress->province)) ?? '' }}" />
                <select class="rounded-lg md:pr-20 w-full md:w-auto" id="province">
                    <option>
                        <h1 class="px-12">Province</h1>
                    </option>
                </select>
                <x-input id="province-text" type="hidden" name="province" value="{{ $userAddress->province ?? '' }}" />
            </div>
        </div>

        
        <div class="mt-4">
            <x-label for="city" value="City: {{ Str::ucfirst(Str::lower($userAddress->city)) ?? '' }}" />
            <select class="rounded-lg w-full" id="city">
                <option>
                    City
                </option>
            </select>
            <x-input id="city-text" type="hidden" name="city" value="{{ $userAddress->city ?? '' }}" />
        </div>

        <div class="mt-4">
            <x-label for="barangay" value="Barangay: {{ $userAddress->barangay ?? '' }}" />
            <select class="rounded-lg w-full" name="barangay" id="barangay">
                <option>
                    Barangay
                </option>
            </select>
            <x-input id="barangay-text" type="hidden" name="barangay" value="{{ $userAddress->barangay ?? '' }}" />
        </div>
        
        <div class="mt-4">
            <x-label for="" value="Available Hours: {{ $userAddress->available_hours ?? '' }}" />
            
        </div>                            

        <div class="flex items-center justify-end mt-4">
            <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                {{ __('Update Address') }}
            </x-button>
        </div>

    </form>
</div>
