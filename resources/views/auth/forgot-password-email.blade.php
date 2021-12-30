<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        
        <div class="w-full flex justify-center items-center mb-4 text-2xl text-gray-200">
            <h1 class="w-1/2 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </h1>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="flex justify-center items-center w-full">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-96 ml-4" type="email" name="email" :value="old('email')" required autofocus />

                <x-button class="ml-2 text-white bg-custom-violet py-2 px-4">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>

         
            
        </form>
    </x-auth-card>
</x-guest-layout>
