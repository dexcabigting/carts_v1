<div class="p-5">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex-col bg-custom-blacki flex justify-center items-center">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
            {{ __('User Credentials') }}
        </h2>

        <form class="bg-custom-blacki w-96" method="POST" wire:submit.prevent="store">
            @csrf

            <div class="text-gray-900">
                <x-label  for="name" :value="__('Name')"/>
                <x-input wire:model="form.name" id="name" class="block mt-1 w-full " type="text" name="name" value="{{ old('name') }}" autofocus required />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
            </div>

            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />
                <x-input wire:model="form.phone" id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ old('phone') }}" required />
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

            <div class="flex mt-4 gap-5 justify-center">
                <div>
                    <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet">
                        {{ __('Create User') }}
                    </x-button>
                </div>
                
                <div>
                    <x-button wire:click.prevent="closeCreateModal()" type="button" class="bg-red-500 text-gray-100 text-xl font-bold px-4 py-2">
                        {{ __('Close') }}
                    </x-button>
                </div>  
            </div>
        </form>
    </div>
</div>
