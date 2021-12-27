<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoriesIndex extends Component
{
    use WithPagination;

    public $checkedCategories;
    public $selectAll = false;
    public $createModal = 0;
    public $editModal = 0;
    public $deleteModal = 0;
    public $categoryId;
    public $search;
    public $sortBy = 'ctgr_name';
    public $orderBy = 'asc';

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeCreateModal',
        'closeEditModal',
        'closeDeleteModal',
        'cleanse',
        'unsetCheckedCategories',
    ];

    public function mount()
    {
        $this->checkedCategories = [];
        $this->categoryId = [];
    }

    public function render()
    {
        $categories = $this->categories->paginate(10);

        return view('livewire.categories.categories-index', compact('categories'));
    }

    public function getCategoriesProperty()
    {
        $search = '%' . $this->search . '%';

        $sortBy = $this->sortBy;

        $orderBy = $this->orderBy;

        return Category::select('id', 'ctgr_name', 'ctgr_description', 'created_at')
            ->where('ctgr_name', 'like', $search)
            ->orderBy($sortBy, $orderBy);
    }

    public function updatedSelectAll($value)
    {
        $search = '%' . $this->search . '%';

        if ($value) {
            $this->checkedCategories = Category::where('ctgr_name', 'like', $search)
                ->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->flip()
                ->map(fn ($item) => true)
                ->toArray();
        } else {
            $this->checkedCategories = [];
        }
    }

    public function getCheckedKeysProperty()
    {
        return array_keys($this->checkedCategories);
    }

    public function updatedCheckedCategories()
    {
        $this->selectAll = false;

        $this->checkedCategories = array_filter($this->checkedCategories);
    }

    public function updatingSearch()
    {
        if(is_array($this->checkedCategories)) {
            $this->checkedCategories = [];

            $this->selectAll = false;

            $this->resetPage();
        }
    }

    public function openCreateModal()
    {
        $this->createModal = true;
    }

    public function closeCreateModal()
    {
        $this->createModal = false;
    }

    public function openEditModal($id)
    {
        $this->categoryId = $id;

        $this->editModal = true;
    }

    public function closeEditModal()
    {
        $this->editModal = false;
    }

    public function openDeleteModal($id)
    {
        $this->categoryId = $id;

        $this->deleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
    }

    public function cleanse()
    {
        $this->checkedCategories = [];

        $this->selectAll = false;
    }

    public function unsetCheckedCategories($ids)
    {
        if (is_array($this->checkedCategories)) {
            foreach ($ids as $id) {
                unset($this->checkedCategories['$id']);
            }
        }
    }

    public function resetFilter()
    {
        $this->reset(['search', 'sortBy', 'orderBy']);
    }
}
