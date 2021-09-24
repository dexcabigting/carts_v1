<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    @if($createModal)
        @livewire('products.products-create')        
    @elseif($editModal)
        @livewire('products.products-edit')   
    @endif

    @include('products.index', ['products' => $products])           
</div>

