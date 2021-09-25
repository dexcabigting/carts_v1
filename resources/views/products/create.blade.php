<div class="">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex justify-around">
        <div>
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Product Info') }}
            </h2>
        </div>
    </div>
    
    <form method="POST" wire:submit.prevent="store" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-row divide-gray-200 gap-5">
            <div class="w-48">
                <div>
                    <x-label for="prd_name" :value="__('Name')"/>
                    <x-input  wire:model="form.prd_name" id="prd_name" class="block mt-1 w-full" type="text" value="{{ old('prd_name') }}" autofocus required />
                </div>

                <div class="mt-4">
                    <x-label for="prd_description" :value="__('Description')" />
                    <x-input wire:model="form.prd_description" id="prd_description" class="block mt-1 w-full" type="text" value="{{ old('prd_description') }}" required />
                </div>

                <div class="mt-4">
                    <x-label for="prd_price" :value="__('Price')" />
                    <x-input  id="prd_price" wire:model="form.prd_price" type="text" class="block mt-1 w-full"/>
                </div>

                <div class="mt-4">
                    <x-label for="prd_image" :value="__('Image')" />
                    <label
                        class="mt-1 flex flex-col font-semibold text-xs uppercase tracking-widest items-center bg-white rounded-md shadow-md border border-blue cursor-pointer hover:bg-gray-800 hover:text-white text-gray-800 ease-linear transition-all duration-150">
                        <span class="px-4 py-2">Select a file</span>
                        <input type='file' class="hidden" />
                    </label>
                </div>
            </div>
            
            <div class="flex flex-row gap-5">
                <div class="w-16">
                    <div>
                        <x-label for="xxsmall" :value="__('XXSmall')"/>
                        <x-input id="xxsmall" class="block mt-1 w-full" type="text" value="{{ old('xxsmall') }}" autofocus />
                    </div>
                    
                    <div class="mt-4">
                        <x-label for="xsmall" :value="__('XSmall')"/>
                        <x-input id="xsmall" class="block mt-1 w-full" type="text" value="{{ old('xsmall') }}" autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="small" :value="__('Small')"/>
                        <x-input id="small" class="block mt-1 w-full" type="text" value="{{ old('small') }}" autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="medium" :value="__('Medium')"/>
                        <x-input id="medium" class="block mt-1 w-full" type="text" value="{{ old('medium') }}" autofocus />
                    </div>
                </div>

                <div class="w-16">
                    <div>
                        <x-label for="large" :value="__('Large')"/>
                        <x-input id="large" class="block mt-1 w-full" type="text" value="{{ old('large') }}" autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="xlarge" :value="__('XLarge')"/>
                        <x-input id="xlarge" class="block mt-1 w-full" type="text" value="{{ old('xlarge') }}" autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="xxlarge" :value="__('XXLarge')"/>
                        <x-input id="xxlarge" class="block mt-1 w-full" type="text" value="{{ old('xxlarge') }}" autofocus />
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-4 gap-5">
            <div>
                <x-button type="button" wire:click="closeCreateModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
            
            <div>
                <x-button>
                    {{ __('Add Product') }}
                </x-button>
            </div>  
        </div>
    </form>
</div>

