<div>
    @if($createModal)
        @livewire('fabrics.fabrics-create')
    @endif

    {{-- @elseif($editModal)
        @livewire('products.products-edit', ['id' => $productId])
    @elseif($deleteModal)
        @livewire('products.products-delete', ['id' => $this->productId])
    @endif --}}

    @include('fabrics.index', ['fabrics' => $fabrics])
</div>
