<div class="p-5">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex flex-col bg-custom-blacki justify-center items-center">
        <div>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('User Credentials') }} {{ $form['role'] }}
            </h2>
        </div>

        <form class="bg-custom-blacki w-96" wire:submit.prevent="store">
            @csrf
            <div class="flex flex-col gap-5">
                <div class="text-gray-900">
                    <x-label  for="name" :value="__('Name')"/>
                    <x-input wire:model="form.name" id="name" class="block mt-1 w-full text-black" type="text" name="name" value="{{ old('name') }}" autofocus required />
                </div>

                <div class="">
                    <x-label for="email" :value="__('Email')" />
                    <x-input wire:model="form.email" id="email" class="block mt-1 w-full text-black" type="email" name="email" value="{{ old('email') }}" required />
                </div>

                <div class="">
                    <x-label for="phone" :value="__('Phone')" />
                    <x-input wire:model="form.phone" id="phone" class="block mt-1 w-full text-black" type="text" name="phone" value="{{ old('phone') }}" required />
                </div>

                <div class="">
                    <x-label for="password" :value="__('Password')" />
                    <x-input wire:model="form.password" id="password" class="block mt-1 w-full text-black"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <div class="">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-input wire:model="form.password_confirmation" id="password_confirmation" class="block mt-1 w-full text-black"
                                    type="password"
                                    name="password_confirmation" required />
                </div>

                <div class="">
                    <x-label :value="__('Role')" />
                    @foreach($roles as $role)
                        <div wire:key="{{ $loop->index }}-role">
                            <input wire:model="form.role" type="radio" value="{{ $role['id'] }}" required/>
                            <span>{{ $role['role'] }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex gap-5 justify-center">
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
            </div>
        </form>
    </div>
</div>
