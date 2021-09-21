<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Once you have verified the code sent to your number, we will redirect you to the password reset page.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.phone') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Phone')" />

                <x-input id="email" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Send Verification Code') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
