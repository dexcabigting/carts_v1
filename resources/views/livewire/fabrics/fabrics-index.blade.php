<div>
    @if($createModal)
        @livewire('fabrics.fabrics-create')
    @elseif($editModal)
        @livewire('fabrics.fabrics-edit', ['id' => $fabricId])
    @elseif($deleteModal)
        @livewire('fabrics.fabrics-delete', ['id' => $this->fabricId])
    @endif

    @include('fabrics.index', ['fabrics' => $fabrics])
</div>
