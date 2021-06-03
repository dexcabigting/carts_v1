<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    <x-success-message class="mb-4" />
                    <x-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('profile.update') }}">
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

                        <div class="mt-4">
                            <x-label for="password" :value="__('New Password')" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button>
                                {{ __('Update Profile') }}
                            </x-button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
