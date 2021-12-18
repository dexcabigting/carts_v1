<div>
    <x-success-fail-message class="mb-4" />
    <x-validation-errors class="mb-4" :errors="$errors" />

    <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
        {{ __('Credentials') }}
    </h2>

    <form>
        @csrf

        <div class>
            <x-label for="name" :value="__('Name')" />
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
