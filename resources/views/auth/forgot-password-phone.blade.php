<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <div class="w-full flex items-center justify-center">
        <div class="w-full text-center mb-4 text-2xl text-gray-600 px-24">
            {{ __('Forgot your password? No problem. Once you have verified the code sent to your number, we will redirect you to the password reset page.') }}
        </div>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div class="w-full flex items-center justify-center">
        <form method="POST" action="{{ route('password.phone') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-12 mx-2 w-full flex items-center justify-center">
                <x-label for="email" :value="__('Phone')" />

                <x-input id="email" class="block w-72 ml-4" type="tel" name="phone" :value="old('phone')" required autofocus />

                <x-button class="ml-2 text-xs md:text-base px-4 py-2 bg-custom-violet font-bold text-white">
                    {{ __('Send Verification Code') }}
                </x-button>
            </div>

            
        </form>
    </div>
    </x-auth-card>
</x-guest-layout>
