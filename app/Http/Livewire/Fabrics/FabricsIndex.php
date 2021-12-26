<?php

namespace App\Http\Livewire\Fabrics;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Fabric;

class FabricsIndex extends Component
{
    use WithPagination;

    public $checkedFabrics;
    public $selectAll = false;
    public $createModal = 0;
    public $editModal = 0;
    public $deleteModal = 0;
    public $fabricId;
    public $search;
    public $sortBy = 'fab_name';
    public $orderBy = 'asc';

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeCreateModal',
        'closeEditModal',
        'closeDeleteModal',
        'cleanse',
        'unsetCheckedFabrics',
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

        $sortBy = $this->sortBy;

        $orderBy = $this->orderBy;

        return Fabric::select('id', 'fab_name', 'fab_description', 'created_at')
            ->where('fab_name', 'like', $search)
            ->orderBy($sortBy, $orderBy);
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

    public function updatingSearch()
    {
        if(is_array($this->checkedFabrics)) {
            $this->checkedFabrics = [];

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
        $this->fabricId = $id;

        $this->editModal = true;
    }

    public function closeEditModal()
    {
        $this->editModal = false;
    }

    public function openDeleteModal($id)
    {
        $this->fabricId = $id;

        $this->deleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
    }

    public function cleanse()
    {
        $this->checkedFabrics = [];

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

    public function resetFilter()
    {
        $this->reset(['search', 'sortBy', 'orderBy']);
    }
}
