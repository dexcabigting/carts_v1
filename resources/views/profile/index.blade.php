<x-app-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight h-full">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 h-screen w-full flex justify-center items-center">
        <div class="max-w-4xl mx-auto sm:px-6 w-full mt-32 2xl:mt-24">   
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-custom-blacki border-gray-500 divide-y divide-gray-300">

                    <div class="pb-4">
                        <x-success-fail-message class="mb-4" />
                        <x-validation-errors class="mb-4" :errors="$errors" />

                        <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
                            {{ __('Credentials') }}
                        </h2>

                        <form method="POST" action="{{ route('profile.update-credentials') }}">
                            @method('PUT')
                            @csrf

                            <div class>
                                <x-label for="name" :value="__('Name')"/>
                                <x-input id="name" class="block mt-1 w-full text-black" type="text" name="name" value="{{ Auth::user()->name }}" autofocus required />
                            </div>

                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ Auth::user()->email }}" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ Auth::user()->phone }}" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                                    {{ __('Update Credentials') }}
                                </x-button>
                            </div>

                        </form>
                    </div>

                    <div class="pt-4">
                        <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
                            {{ __('Password') }}
                        </h2>

                        <form method="POST" action="{{ route('profile.update-password') }}">
                            @method('PUT')
                            @csrf

                            <div class="mt-4">
                                <x-label for="current_password" :value="__('Current Password')" />
                                <x-input id="current_password" class="block mt-1 w-full"
                                                type="password"
                                                name="current_password"
                                                required />
                            </div>

                            <div class="mt-4">
                                <x-label for="new_password" :value="__('New Password')" />
                                <x-input id="new_password" class="block mt-1 w-full"
                                                type="password"
                                                name="new_password"
                                                required />
                            </div>

                            <div class="mt-4">
                                <x-label for="new_password_confirmation" :value="__('Confirm New Password')" />
                                <x-input id="new_password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="new_password_confirmation" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                                    {{ __('Update Password') }}
                                </x-button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>  
    </div>
</x-app-user-layout>
