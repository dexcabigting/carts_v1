 <!-- Validation Errors -->
 <x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('sms.validator') }}" >
    @csrf
    <div>
        <x-label :value="__('Phone')" />
        <x-input class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus />
    </div>

    <x-button class="ml-3">
        {{ __('Send SMS') }}
    </x-button>
</form>