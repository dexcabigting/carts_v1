<x-auth-card>
    <div class="px-12">
        <section class="w-full flex justify-center items-center my-24 flex-col">
            <h1 class="font-semibold  text-7xl md:text-9xl text-custom-blacki my-4">REGISTER</h1>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form class="w-full max-w-lg" >
                @csrf

                <!-- Name -->
                <div>
                    <x-label class="text-xl text-purple-100  " for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label class="text-xl text-purple-100  " for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-label class="text-xl text-purple-100  " for="phone" :value="__('Phone')" />

                    <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-label class="text-xl text-purple-100  " for="home_address" :value="__('Home Address')" />

                    <x-input id="home_address" class="block mt-1 w-full" type="text" name="home_address" :value="old('home_address')" required />
                </div>
                <div class="mt-4">
                    <x-label  class="text-xl text-purple-100" for="region" :value="__('Region')" />
                    <select class="w-full rounded-lg" id="region">
                        <option>Region</option>
                    </select>
                    <x-input id="region-text" type="hidden" name="region" :value="old('region')" />
                </div>
                <div class="mt-4">
                    <x-label class="text-xl text-purple-100" for="province" :value="__('Province')" />
                    <select class="w-full rounded-lg" id="province">
                        <option>
                            Province
                        </option>
                    </select>
                    <x-input id="province-text" type="hidden" name="province" :value="old('province')" />
                </div>
                <div class="mt-4">
                    <x-label class="text-xl text-purple-100" for="city" :value="__('City')" />

                    <select class="w-full rounded-lg" id="city">
                        <option>City</option>
                    </select>
                    <x-input id="city-text" type="hidden" name="city" :value="old('city')" />
                </div>
                <div class="mt-4">
                    <x-label class="text-xl text-purple-100" for="barangay" :value="__('Barangay')" />
                    <select class="w-full rounded-lg" name="barangay" id="barangay">
                        <option>Barangay</option>
                    </select>
                    <x-input id="barangay-text" type="hidden" name="barangay" :value="old('barangay')" />
                </div>
                

                <!-- Password -->
                <div class="mt-4">
                    <x-label class="text-xl text-purple-100  " for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label class="text-xl text-purple-100  " for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="flex items-center flex-col justify-center mt-4">
                    <div>
                        <x-button class="md:mt-4 mt-12 uppercase hover:bg-purple-900 hover:text-purple-100 text-3xl font-semibold text-white px-32 md:px-44 py-6 my-6 w-full bg-custom-violet">
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
    </div>
</x-auth-card>

    
