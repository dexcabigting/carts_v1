<div>
    @if($createModal)
        @livewire('fabrics.fabrics-create')
    @elseif($editModal)
        @livewire('fabrics.fabrics-edit', ['id' => $fabricId])
    @endif

    {{-- @elseif($editModal)
        @livewire('products.products-edit', ['id' => $productId])
    @elseif($deleteModal)
        @livewire('products.products-delete', ['id' => $this->productId])
    @endif --}}

    @include('fabrics.index', ['fabrics' => $fabrics])
</div>
