<div class="pt-4">
    <x-success-fail-message class="mb-4" />
    <x-validation-errors class="mb-4" :errors="$errors" />

    <div class="flex flex-col gap-5">
        <div>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Address') }}
            </h2>
        </div>

        <div>
            <x-button type="button" wire:click="openCreateModal()" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500">
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
      

    <form wire:submit.prevent="updateAddress(Object.fromEntries(new FormData($event.target)))">
        @csrf
       
        <div class="mt-4">
            <x-label class="text-xl mb-4 text-white  " for="home_address" :value="__('Home Address: ' . $userAddress->home_address )" />

            <x-input class="block mt-1 w-full" type="text" placeholder="ex. Street Apartment no." name="home_address" value="{{ $userAddress->home_address ?? '' }}"/>
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
                <x-input id="region-text" type="hidden" name="region"/>
            </div>

            <div class="mt-4 md:ml-4">
                <x-label for="province" value="Province: {{ Str::ucfirst(Str::lower($userAddress->province)) ?? '' }}" />
                <select class="rounded-lg md:pr-20 w-full md:w-auto" id="province">
                    <option>
                        <h1 class="px-12">Province</h1>
                    </option>
                </select>
                <x-input id="province-text" type="hidden" name="province"/>
            </div>
        </div>

        
        <div class="mt-4">
            <x-label for="city" value="City: {{ Str::ucfirst(Str::lower($userAddress->city)) ?? '' }}" />
            <select class="rounded-lg w-full" id="city">
                <option>
                    City
                </option>
            </select>
            <x-input id="city-text" type="hidden" name="city"/>
        </div>

        <div class="mt-4">
            <x-label for="barangay" value="Barangay: {{ $userAddress->barangay ?? '' }}" />
            <select class="rounded-lg w-full" name="barangay" id="barangay">
                <option>
                    Barangay
                </option>
            </select>
            <x-input id="barangay-text" type="hidden" name="barangay"/>
        </div>                          

        <div class="flex flex-row mt-4 gap-5">
            <x-button type="submit" class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                {{ __('Update Address') }}
            </x-button>

            <x-button type="button" wire:click="openDeleteModal()" class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                {{ __('Delete Address') }}
            </x-button>
        </div>

    </form>
</div>
