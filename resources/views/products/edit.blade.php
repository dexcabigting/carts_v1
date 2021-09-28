<div>
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
        {{ __('Product Info') }}
    </h2>

    <form method="POST" wire:submit.prevent="update" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="flex flex-row divide-gray-200 gap-5">
            <div wire:loading.remove class="w-48">
                <x-label :value="__('Image Preview')"/>
                <div class="bg-gray-400 w-auto h-auto sm:rounded-lg mt-1 p-5">
                    <div>
                        @if ($form['prd_image'])
                            <img src="{{ $form['prd_image']->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                        @else
                            <img src="{{ Storage::url('public/' . $product->prd_image) }}?{{ rand() }}"  />
                        @endif
                    </div>
                </div>
            </div>

            <div class="w-48">
                <div>
                    <x-label for="prd_name" :value="__('Name')"/>
                    <x-input  wire:model.defer="form.prd_name" id="prd_name" class="block mt-1 w-full" type="text" value="{{ old('prd_name') }}" autofocus required />
                </div>

                <div class="mt-4">
                    <x-label for="prd_description" :value="__('Description')" />
                    <x-input wire:model.defer="form.prd_description" id="prd_description" class="block mt-1 w-full" type="text" value="{{ old('prd_description') }}" required />
                </div>

                <div class="mt-4">
                    <x-label for="prd_price" :value="__('Price')" />
                    <x-input  id="prd_price" wire:model.defer="form.prd_price" type="text" class="block mt-1 w-full"/>
                </div>

                <div class="mt-4">
                    <x-label for="prd_image" :value="__('Image')" />
                    <input type="file" wire:model.defer="form.prd_image" />
                    <div wire:loading wire:target="form.prd_image">Uploading...</div>
                </div>
            </div>
            
            <div class="flex flex-row gap-5">
                <div class="w-16">
                    <div>
                        <x-label for="xxsmall" :value="__('XXSmall')"/>
                        <x-input id="xxsmall" wire:model.defer="form.xxsmall" class="block mt-1 w-full" type="text" value="{{ old('xxsmall') }}" autofocus />
                    </div>
                    
                    <div class="mt-4">
                        <x-label for="xsmall" :value="__('XSmall')"/>
                        <x-input id="xsmall" wire:model.defer="form.xsmall" class="block mt-1 w-full" type="text" value="{{ old('xsmall') }}" autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="small" :value="__('Small')"/>
                        <x-input id="small" wire:model.defer="form.small" class="block mt-1 w-full" type="text" value="{{ old('small') }}" autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="medium" :value="__('Medium')"/>
                        <x-input id="medium" wire:model.defer="form.medium" class="block mt-1 w-full" type="text" value="{{ old('medium') }}" autofocus />
                    </div>
                </div>

                <div class="w-16">
                    <div>
                        <x-label for="large" :value="__('Large')"/>
                        <x-input id="large" wire:model.defer="form.large" class="block mt-1 w-full" type="text" value="{{ old('large') }}" autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="xlarge" :value="__('XLarge')"/>
                        <x-input id="xlarge" wire:model.defer="form.xlarge" class="block mt-1 w-full" type="text" value="{{ old('xlarge') }}" autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="xxlarge" :value="__('XXLarge')"/>
                        <x-input id="xxlarge" wire:model.defer="form.xxlarge" class="block mt-1 w-full" type="text" value="{{ old('xxlarge') }}" autofocus />
                    </div>
                </div>
            </div>
        </div>

        <div class="flex mt-4 gap-5 ">
            <div>
                <x-button type="button" wire:click="closeEditModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
            
            <div>
                <x-button>
                    {{ __('Update Product') }}
                </x-button>
            </div>  
        </div>
    </form>
</div>

