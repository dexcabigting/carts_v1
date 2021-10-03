@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-white']) }}>
    {{ $value ?? $slot }}
</label>
