<form method="POST" action="{{ route('pr.replace') }}">
    @csrf
    <div>
        <x-label :value="__('Phone')" />
        <x-input class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
    </div>

    <x-button class="ml-3">
        {{ __('Replace') }}
    </x-button>
</form>

<h1> {{ $phone }}</h1>