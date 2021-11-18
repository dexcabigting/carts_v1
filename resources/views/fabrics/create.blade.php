<div class="py-5 w-auto overflow-y-auto">
    <div class="px-5">
        <x-success-fail-message/>
        <x-validation-errors :errors="$errors" />
    </div>
    
    <form wire:submit.prevent="store">
        @csrf
        <div class="flex flex-row divide-x-4 divide-gray-600 gap-5">
            <div class="w-48">
                <div class="flex justify-around">
                    <div>
                        <h2 class="font-semibold text-l leading-tight mb-4">
                            {{ __('Fabric Info') }}
                        </h2>
                    </div>
                </div>       

                <div>
                    <x-label :value="__('Name')"/>
                    <x-input  wire:model.lazy="form.fab_name" class="block mt-1 w-full text-black" type="text" value="{{ old('fab_name') }}" autofocus required />
                </div>

                <div class="mt-4">
                    <x-label for="fab_description" :value="__('Description')" />
                    <x-input wire:model.lazy="form.fab_description" id="fab_description" class="block mt-1 w-full text-black" type="text" value="{{ old('fab_description') }}" required />
                </div>
            </div>
        </div>
        
        <div class="flex justify-center px-5 mt-4 gap-5 items-center">
            <div>
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet my-3">
                    {{ __('Add Fabric') }}
                </x-button>
            </div>  
            <div>
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet my-3" type="button" wire:click="closeCreateModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </form>
</div>
