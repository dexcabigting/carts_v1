<x-success-fail-message />
<x-validation-errors :errors="$errors" />

<h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
    {{ __('User Credentials') }}
</h2>

<form method="POST" wire:submit.prevent="update">
    @method('PUT')
    @csrf

    <div>
        <x-label for="name" :value="__('Name')"/>
        <x-input wire:model="form.name"
        id="name" class="block mt-1 w-full" type="text" name="name" autofocus required />
    </div>

    <div class="mt-4">
        <x-label for="email" :value="__('Email')" />
        <x-input wire:model="form.email"
        id="email" class="block mt-1 w-full" type="email" name="email" required />
    </div>

    <div class="flex items-center justify-center mt-4">
        <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-bold text-white w-full px-12 py-4 bg-custom-violet my-3">
            {{ __('Update Credentials') }}
        </x-button>
    </div>

</form>