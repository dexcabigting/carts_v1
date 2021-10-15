<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $checkedUsers;
    public $checkedKeys;
    public $userId;
    public $selectAll = 0;
    public $search;
    public $sortBy = 'Name';
    public $orderBy = 'asc';
    public $deleteModal = 0;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeDeleteModal',
        'cleanse',
        'unsetCheckedProducts',
    ];

    public function mount()
    {
        $this->checkedUsers = [];
        $this->checkedKeys = [];
        $this->userId = [];
    }

    public function render()
    {
        $users = $this->users->paginate(5);

        return view('livewire.users.users-index', compact('users')) ;
    }

    public function getUsersProperty()
    {
        $search = '%' . $this->search . '%';

        $sortBy = $this->sortBy;

        $orderBy = $this->orderBy;

        return User::with('role')
            ->where('role_id', 2)
            ->where('name', 'like', $search)
            ->orderBy($sortBy, $orderBy);
    }

    public function updatedSelectAll($value)
    {
        $search = '%' . $this->search . '%';

        $sortBy = $this->sortBy;

        if ($value) {
            $this->checkedUsers = User::with('role')
                ->join('roles', 'roles.id', '=', 'role_id')
                ->where('roles.role', '=', 'Customer')
                ->where($sortBy, 'like', $search)
                ->pluck('users.id')
                ->map(fn ($item) => (string) $item)
                ->flip()
                ->map(fn ($item) => true)
                ->toArray();
        } else {
            $this->checkedUsers = [];
        }
    }

    public function updatedCheckedUsers()
    {
        $this->selectAll = false;

        $this->checkedUsers = array_filter($this->checkedUsers);

        $this->checkedKeys = array_keys($this->checkedUsers);
    }

    public function updatedSearch()
    {
        if(is_array($this->checkedUsers)) {
            $this->checkedUsers = [];

            $this->selectAll = false;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openDeleteModal($id)
    {
        $this->userId = $id;

        $this->deleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
    }

    public function cleanse()
    {
        $this->checkedUsers = [];

        $this->checkedKeys = array_keys($this->checkedUsers);

        $this->selectAll = false;
    }

    public function unsetCheckedUsers($ids)
    {
        if (is_array($this->checkedUsers)) {
            foreach ($ids as $id) {
                unset($this->checkedUsers["$id"]);
            }

				$this->selectAll = false;
        }
    }
}
