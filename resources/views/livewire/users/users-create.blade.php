<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create User') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-md mx-auto sm:px-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="pb-4">
                    <x-success-fail-message />
                    <x-validation-errors :errors="$errors" />

                    <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                        {{ __('User Credentials') }}
                    </h2>

                    <form method="POST" wire:submit.prevent="store">
                        @csrf

                        <div>
                            <x-label for="name" :value="__('Name')"/>
                            <x-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" autofocus required />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />
                            <x-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="password" :value="__('Password')" />
                            <x-input wire:model="form.password" id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button>
                                {{ __('Create User') }}
                            </x-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
