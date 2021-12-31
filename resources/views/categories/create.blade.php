<div class="py-5 w-auto overflow-y-auto flex-col flex items-center justify-center">
    <div class="px-5">
        <x-success-fail-message/>
        <x-validation-errors :errors="$errors" />
    </div>
    
    <form wire:submit.prevent="store">
        @csrf
        <div class="flex flex-row divide-x-2 divide-gray-600 gap-2 ml-2">
            <div class="w-56 mx-8">
                <div class="flex justify-center items-center">
                    <div>
                        <h2 class="font-semibold text-l leading-tight mb-4">
                            {{ __('Product Category Info') }}
                        </h2>
                    </div>
                </div>       

                <div>
                    <x-label :value="__('Name')"/>
                    <x-input  wire:model.defer="form.ctgr_name" class="block mt-1 w-full text-black" type="text" value="{{ old('ctgr_name') }}" autofocus required />
                </div>

                <div class="mt-4">
                    <x-label for="ctgr_description" :value="__('Description')" />
                    <x-input wire:model.defer="form.ctgr_description" id="ctgr_description" class="block mt-1 w-full text-black" type="text" value="{{ old('ctgr_description') }}" required />
                </div>
            </div>
        </div>
        
        <div class="flex ml-4 px-5 mt-4 gap-5 items-center">
            <div>
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet my-3">
                    {{ __('Add Category') }}
                </x-button>
            </div>  
            <div>
                <x-button type="button" wire:click.prevent="closeCreateModal" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500 my-3">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </form>
</div>
