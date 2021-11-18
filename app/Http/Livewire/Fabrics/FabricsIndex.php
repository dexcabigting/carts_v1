<?php

namespace App\Http\Livewire\Fabrics;

use Livewire\Component;
use App\Models\Fabric;
use Livewire\WithPagination;

class FabricsIndex extends Component
{
    use WithPagination;

    public $checkedFabrics;
    public $selectAll = false;
    public $createModal = false;
    public $editModal = false;
    public $deleteModal = false;
    public $fabricId;
    public $search;
    public $sortColumn = 'prd_name';
    public $sortDirection = 'asc';

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeCreateModal',
        'closeEditModal',
        'closeDeleteModal',
        'cleanse',
        'unsetCheckedProducts',
    ];

    public function mount()
    {
        $this->checkedFabrics = [];
        $this->fabricId = [];
    }

    public function render()
    {
        $fabrics = $this->fabrics->paginate(10);

        return view('livewire.fabrics.fabrics-index', compact('fabrics'));
    }

    public function getFabricsProperty()
    {
        $search = '%' . $this->search . '%';

        $sortColumn = $this->sortColumn;

        $sortDirection = $this->sortDirection;

        return Fabric::select('id', 'fab_name', 'fab_description', 'created_at')
            ->where('fab_name', 'like', $search)
            ->orderBy($sortColumn, $sortDirection);
    }

    public function updatedSelectAll($value)
    {
        $search = '%' . $this->search . '%';

        if ($value) {
            $this->checkedFabrics = Fabric::where('fab_name', 'like', $search)
                ->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->flip()
                ->map(fn ($item) => true)
                ->toArray();
        } else {
            $this->checkedFabrics = [];
        }
    }

    public function getCheckedKeysProperty()
    {
        return array_keys($this->checkedFabrics);
    }

    public function updatedCheckedFabrics()
    {
        $this->selectAll = false;

        $this->checkedFabrics = array_filter($this->checkedFabrics);
    }

    public function updatedSearch()
    {
        if(is_array($this->checkedFabrics)) {
            $this->checkedFabrics = [];

            $this->selectAll = false;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
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
        $this->productId = $id;

        $this->editModal = true;
    }

    public function closeEditModal()
    {
        $this->editModal = false;
    }

    public function openDeleteModal($id)
    {
        $this->productId = $id;

        $this->deleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
    }

    public function cleanse()
    {
        $this->checkedProducts = [];

        $this->selectAll = false;
    }

    public function unsetCheckedFabrics($ids)
    {
        if (is_array($this->checkedFabrics)) {
            foreach ($ids as $id) {
                unset($this->checkedFabrics['$id']);
            }
        }
    }
}
