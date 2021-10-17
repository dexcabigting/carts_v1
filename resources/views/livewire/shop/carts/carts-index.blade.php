<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carts') }}
        </h2>
    </x-slot>

    @if($cartEditModal)
        @livewire('shop.carts.carts-edit', ['id' => $cartId])
    @elseif($cartDeleteModal)
        @livewire('shop.carts.carts-delete', ['id' => $cartId])
    @endif

    @include('shop.carts.index')
</div>
