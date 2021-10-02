<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carts') }}
        </h2>
    </x-slot>

    @if($cartModal)
        @livewire('shop.carts.carts-edit', ['id' => $cartId])   
    @endif

    @include('shop.carts.index')
</div>
