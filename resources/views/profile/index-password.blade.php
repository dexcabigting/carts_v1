<div>
    <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
        {{ __('Password') }}
    </h2>

    <form>
        @csrf

        <div class="mt-4">
            <x-label for="current_password" :value="__('Current Password')" />
            <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required />
        </div>

        <div class="mt-4">
            <x-label for="new_password" :value="__('New Password')" />
            <x-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" required />
        </div>

        <div class="mt-4">
            <x-label for="new_password_confirmation" :value="__('Confirm New Password')" />
            <x-input id="new_password_confirmation" class="block mt-1 w-full" type="password" name="new_password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                {{ __('Update Password') }}
            </x-button>
        </div>
    </form>
</div>
