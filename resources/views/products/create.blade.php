<div class="">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
        {{ __('Product Info') }}
    </h2>

    <form method="POST" wire:submit.prevent="store">
        @csrf

        <div>
            <x-label for="prd_name" :value="__('Name')"/>
            <x-input  wire:model="form.prd_name" id="prd_name" class="block mt-1 w-full" type="text" prd_name="prd_name" value="{{ old('prd_name') }}" autofocus required />
        </div>

        <div class="mt-4">
            <x-label for="prd_description" :value="__('Description')" />
            <x-input wire:model="form.prd_description" id="prd_description" class="block mt-1 w-full" type="text" name="prd_description" value="{{ old('prd_description') }}" required />
        </div>

        <div class="mt-4">
            <x-label for="prd_price" :value="__('Price')" />
            <x-input  id="prd_price" wire:model="form.prd_price" type="text" class="block mt-1 w-full"/>
        </div>

        <div class="flex mt-4 gap-5 ">
            <div>
                <x-button type="button" wire:click="closeCreateModal()">
                            {{ __('Cancel') }}
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

