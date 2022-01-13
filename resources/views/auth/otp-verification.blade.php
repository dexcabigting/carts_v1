<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <div class="pt-12 w-full flex flex-col items-center justify-center">
        <div class="mb-4 text-2xl text-center text-gray-600 mx-2">
            {{ __('Please enter the verification code.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update-phone') }}">
            @csrf

            <!-- OTP -->
            <div class="w-96">
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <x-label :value="__('Verification Code')" />

                <x-input class="block mt-1 w-full" type="text" name="otp" :value="old('otp')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4 ">
                <x-button class="text-white bg-custom-violet px-4 py-2">
                    {{ __('Confirm Verification Code') }}
                </x-button>
            </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
