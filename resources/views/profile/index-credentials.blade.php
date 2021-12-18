<div>
    <x-success-fail-message class="mb-4" />
    <x-validation-errors class="mb-4" :errors="$errors" />

    <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
        {{ __('Credentials') }}
    </h2>

    <form>
        @csrf

        <div class>
            <x-label :value="__('Name')" />
            <x-input wire:model.defer="form.name" class="block mt-1 w-full text-black" type="text" autofocus required />
        </div>

        <div class="mt-4">
            <x-label :value="__('Email')" />
            <x-input wire:model.defer="form.email" class="block mt-1 w-full" type="email" required />
        </div>

        <div class="mt-4">
            <x-label :value="__('Phone')" />
            <x-input wire:model.defer="form.phone" class="block mt-1 w-full" type="text" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                {{ __('Update Credentials') }}
            </x-button>
        </div>
    </form>
</div>
