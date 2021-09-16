<form method="POST" action="{{ route('sms.send') }}" >
    @csrf
    <div>
        <x-label for="phone" :value="__('Phone')" />
        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
    </div>

    <div>
        <x-label for="msg" :value="__('Message')" />
        <x-input id="msg" class="block mt-1 w-full" type="text" name="msg" :value="old('msg')" required autofocus />
    </div>

    <x-button class="ml-3">
        {{ __('Send SMS') }}
    </x-button>
</form>