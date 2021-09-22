<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Please enter the verification code.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update-phone') }}">
            @csrf

            <!-- OTP -->
            <div>
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <x-label :value="__('Verification Code')" />

                <x-input class="block mt-1 w-full" type="text" name="otp" :value="old('otp')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Confirm Verification Code') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
