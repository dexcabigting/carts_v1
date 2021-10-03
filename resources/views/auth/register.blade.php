<x-guest-layout>
    <x-auth-card>
        
        <section class="md:w-full flex justify-center items-center my-24 flex-col">
        <h1 class="font-bold text-2xl md:text-8xl text-custom-blacki my-4">REGISTER</h1>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="w-full max-w-lg"  method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label class="text-xl text-custom-violet  " for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label class="text-xl text-custom-violet  " for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label class="text-xl text-custom-violet  " for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label class="text-xl text-custom-violet  text-custom-violet " for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label class="text-xl text-custom-violet  " for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center flex-col justify-center mt-4">
                <div>
                <x-button class="uppercase hover:bg-purple-900 hover:text-purple-100 text-3xl font-bold text-white px-44 py-6 my-6 w-full bg-custom-violet">
                    {{ __('Register') }}
                </x-button>
                </div>
                <div>
                <a class="underline text-xl text-gray-600 hover:text-purple-200" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                </div>
               
            </div>
        </form>
        </section>
    </x-auth-card>
</x-guest-layout>
