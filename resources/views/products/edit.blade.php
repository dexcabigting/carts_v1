<div>
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
        {{ __('Product Info') }}
    </h2>

    <form method="POST" wire:submit.prevent="update">
        @method('PUT')
        @csrf

        <div>
            <x-label for="prd_name" :value="__('Name')"/>
            <x-input  wire:model="form.prd_name" id="prd_name" class="block mt-1 w-full" type="text" name="prd_name" autofocus required />
        </div>

        <div class="mt-4">
            <x-label for="prd_description" :value="__('Description')" />
            <x-input wire:model="form.prd_description" id="prd_description" class="block mt-1 w-full" type="text" name="prd_description" required />
        </div>

        <div class="mt-4">
            <x-label for="prd_price" :value="__('Price')" />
            <x-input wire:model="form.prd_price" id="prd_price"  type="text" class="block mt-1 w-full"/>
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

