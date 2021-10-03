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
        <x-input wire:model="form.password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required />
    </div>

    <div class="flex items-center justify-center mt-4">
        <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-bold text-white w-full px-12 py-4 bg-custom-violet my-3">
            {{ __('Create User') }}
        </x-button>
    </div>
</form>