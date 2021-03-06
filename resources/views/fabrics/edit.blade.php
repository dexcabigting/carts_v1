<div class="py-5 w-auto overflow-y-auto">
    <div class="flex justify-center items-center mx-2 w-80 text-sm">
        <x-success-fail-message/>
        <x-validation-errors :errors="$errors" />
    </div>
    
    <form wire:submit.prevent="update">
        @csrf
        <div class="flex flex-row divide-x-2 divide-gray-600 gap-5 ml-10">
            <div class="w-64">
                <div class="flex justify-center items-center">
                    <div>
                        <h2 class="font-semibold text-l leading-tight mb-4">
                            {{ __('Fabric Info') }}
                        </h2>
                    </div>
                </div>       

                <div>
                    <x-label :value="__('Name')"/>
                    <x-input  wire:model.defer="form.fab_name" class="block mt-1 w-full text-black" type="text" value="{{ old('fab_name') }}" autofocus required />
                </div>

                <div class="mt-4">
                    <x-label for="fab_description" :value="__('Description')" />
                    <div >
                    <x-input class="h-40" wire:model.defer="form.fab_description" id="fab_description" class="block mt-1 w-full text-black" type="text" value="{{ old('fab_description') }}" required />
                    </div>               
                </div>
            </div>
        </div>
        
        <div class="flex justify-center px-5 mt-4 gap-5 items-center">
            <div>
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet my-3">
                    {{ __('Update Fabric') }}
                </x-button>
            </div>  
            <div>
                <x-button type="button" wire:click="closeEditModal" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500 my-3">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </form>
</div>
