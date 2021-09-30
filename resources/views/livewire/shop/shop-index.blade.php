<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    @if ($cartModal)
        
    @endif    

    @include('shop.index', ['products' => $products])      
</div>