<div class="p-5">
    <x-success-fail-message class="mb-4" />
    <x-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="storeAddress(Object.fromEntries(new FormData($event.target)))">
        @csrf
        <div>
            <x-label class="text-xl mb-4 text-white" :value="__('Home Address')" />

            <x-input id="home_address" class="block mt-1 w-full text-black" type="text" name="create_home_address" placeholder="ex. Street Apartment no." />
        </div>

        <!-- Address -->
        <div class="block md:flex fle-row">
            <div class="mt-4 ">
                <x-label for="create_region" :value="__('Region')" />
                <select class="text-black rounded-lg lg:pr-16 pr-4 w-full" id="create_region">
                    <option selected>
                        Region
                    </option>
                </select>
                <x-input id="create_region-text" name="create_region" type="hidden" />
            </div>

            <div class="mt-4 md:ml-4">
                <x-label for="create_province" :value="__('Home Address')" />
                <select class="text-black rounded-lg md:pr-20 w-full md:w-auto" id="create_province">
                    <option>
                        <h1 class="px-12">Province</h1>
                    </option>
                </select>
                <x-input id="create_province-text" name="create_province" type="hidden" />
            </div>
        </div>
        
        <div class="mt-4">
            <x-label for="create_city" :value="__('City')" />
            <select class="text-black rounded-lg w-full" id="create_city">
                <option>
                    City
                </option>
            </select>
            <x-input id="create_city-text" name="create_city" type="hidden" />
        </div>

        <div class="mt-4">
            <x-label for="create_barangay" :value="__('Barangay')"  />
            <select class="text-black rounded-lg w-full" id="create_barangay">
                <option>
                    Barangay
                </option>
            </select>
            <x-input id="create_barangay-text" name="create_barangay" type="hidden" />
        </div>

        <div class="mt-4">
            <x-label :value="__('Set as Default')"  />
                <input type="radio" name="is_main_address" value="1" checked/>
                <label>Yes</label><br>
                <input type="radio" name="is_main_address" value="0" />
                <label >No</label><br>
        </div>

        <div class="flex justify-center items-center gap-5 mt-4"> 
            <div>
                <x-button type="submit" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500">
                    {{ __('Save') }}
                </x-button>
            </div>
            <div>
                <x-button class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500" type="button" wire:click="closeCreateModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </form>
</div>    


    
