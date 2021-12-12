<div class="p-5">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
        {{ __('User Credentials') }}
    </h2>

    <form wire:submit.prevent="update">
        @csrf

        <div>
            <x-label :value="__('Name')"/>
            <x-input wire:model="form.name" class="block mt-1 w-full text-black" type="text" autofocus required />
        </div>

        <div class="mt-4">
            <x-label :value="__('Email')" />
            <x-input wire:model="form.email" class="block mt-1 w-full text-black" type="email" required />
        </div>

        <div class="mt-4">
            <x-label :value="__('Phone')" />
            <x-input wire:model="form.phone" class="block mt-1 w-full text-black" type="text" required />
        </div>

        <div class="flex mt-4 gap-5 justify-center">
            <div>
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet">
                    {{ __('Update Credentials') }}
                </x-button>
            </div>
            
            <div>
                <x-button wire:click.prevent="closeEditModal()" type="button" class="bg-red-500 text-gray-100 text-xl font-bold px-4 py-2">
                    {{ __('Close') }}
                </x-button>
            </div>  
        </div>
    </form>
</div>
