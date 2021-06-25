<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6">   
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 divide-y divide-gray-300">

                    <div class="pb-4">
                        <x-success-fail-message class="mb-4" />
                        <x-validation-errors class="mb-4" :errors="$errors" />

                        <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                            {{ __('Credentials') }}
                        </h2>

                        <form method="POST" action="{{ route('profile.update-credentials') }}">
                            @method('PUT')
                            @csrf

                            <div>
                                <x-label for="name" :value="__('Name')"/>
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ Auth::user()->name }}" autofocus required />
                            </div>

                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ Auth::user()->email }}" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button>
                                    {{ __('Update Credentials') }}
                                </x-button>
                            </div>

                        </form>
                    </div>

                    <div class="pt-4">
                        <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
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
                                <x-button>
                                    {{ __('Update Password') }}
                                </x-button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>  
    </div>
</x-app-layout>
