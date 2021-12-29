<div>
    <x-success-fail-message class="mb-4" />
    <x-validation-errors class="mb-4" :errors="$errors" />

    <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
        {{ __('Password') }}
    </h2>

    <form wire:submit.prevent="updatePassword">
        @csrf

        <div class="mt-4">
            <x-label :value="__('Current Password')" />
            <x-input wire:model.defer="form.current_password" class="block mt-1 w-full" type="password" required />
        </div>

        <div class="mt-4">
            <x-label :value="__('New Password')" />
            <x-input wire:model.defer="form.new_password" class="block mt-1 w-full" type="password" required />
        </div>

        <div class="mt-4">
            <x-label :value="__('Confirm New Password')" />
            <x-input wire:model.defer="form.new_password_confirmation" class="block mt-1 w-full" type="password" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                {{ __('Update Password') }}
            </x-button>
        </div>
    </form>
</div>
