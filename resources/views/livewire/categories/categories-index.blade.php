<div>
    @if($createModal)
        @livewire('categories.categories-create')
    @elseif($editModal)
        @livewire('categories.categories-edit', ['id' => $categoryId])
    @elseif($deleteModal)
        @livewire('categories.categories-delete', ['id' => $this->categoryId])
    @endif

    @include('categories.index', ['categories' => $categories])
</div>
