<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use App\Models\User;
use App\Models\Role;

use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $checkedUsers;
    public $userId;
    public $selectAll = false;
    public $search;
    public $sortBy = 'name';
    public $orderBy = 'asc';
    public $createModal = false;
    public $editModal = false;
    public $deleteModal = false;
    public $query = 'users';

    protected $listeners = [
        'refreshParent' => '$refresh',
        'closeCreateModal',
        'closeEditModal',
        'closeDeleteModal',
        'cleanse',
        'unsetCheckedUsers',
    ];

    public function mount()
    {
        $this->checkedUsers = [];
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

        if($this->query == 'users') {
            $query = User::with('role');
        } else {
            $query = User::onlyTrashed()->with('role');
        }

        return $query
            ->where('role_id', Role::where('role', '=', 'Customer')->first()->id)
            ->where('name', 'like', $search)
            ->orderBy($sortBy, $orderBy);
    }

    public function getCheckedKeysProperty()
    {
        return array_keys($this->checkedUsers);
    }

    public function updatedSelectAll($value)
    {
        $search = '%' . $this->search . '%';

        $sortBy = $this->sortBy;

        if($this->query == 'users') {
            $query = User::with('role');
        } else {
            $query = User::onlyTrashed()->with('role');
        }

        if ($value) {
            $this->checkedUsers = $query
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

    public function updatingQuery()
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
        $this->userId = $id;

        $this->editModal = true;
    }

    public function closeEditModal()
    {
        $this->editModal = false;
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

    public function resetFilter()
    {
        $this->reset(['sortBy', 'orderBy', 'query']);
    }

    public function restoreUser($id)
    {
        // dd('Hello ' . $id);

        $user = User::onlyTrashed()->findOrFail($id);

        $user->restore();

        $user->userAddresses()->onlyTrashed()->restore();

        $this->emit('unsetCheckedUsers', [$id]);

        $this->emit('cleanse');
    }

    public function restoreUsers()
    {
        $userIds = $this->checked_keys;

        dd($userIds);

        $this->emit('unsetCheckedUsers', $userIds);

        $this->emit('cleanse');
    }
}
