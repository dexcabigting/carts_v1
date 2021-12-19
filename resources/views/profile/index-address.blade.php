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
      

    <form wire:submit.prevent="updateAddress">
        @csrf
       
        <div class="mt-4">
            <x-label class="text-xl mb-4 text-white" :value="__('Home Address')" />
            <x-input class="block mt-1 w-full" type="text" placeholder="ex. Street/Apartment no." />
        </div>

        <!-- Address -->
        <div class="block md:flex fle-row">
            <div class="mt-4 ">
                <x-label :value="__('Region')" />
                <select class="rounded-lg lg:pr-16 pr-4 w-full">
                    <option selected>
                        Region
                    </option>
                </select>
            </div>

            <div class="mt-4 md:ml-4">
                <x-label :value="__('Province')" />
                <select class="rounded-lg md:pr-20 w-full md:w-auto">
                    <option>
                        <h1 class="px-12">Province</h1>
                    </option>
                </select>
            </div>
        </div>

        
        <div class="mt-4">
            <x-label :value="__('City')" />
            <select class="rounded-lg w-full">
                <option>
                    City
                </option>
            </select>
        </div>

        <div class="mt-4">
            <x-label :value="__('Barangay')" />
            <select class="rounded-lg w-full" name="barangay" id="barangay">
                <option>
                    Barangay
                </option>
            </select>
        </div>                          

        <div class="flex flex-row mt-4 gap-5">
            <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                {{ __('Update Address') }}
            </x-button>

            <x-button type="button" wire:click.prevent="openDeleteModal()" class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                {{ __('Delete Address') }}
            </x-button>
        </div>
    </form>
</div>
