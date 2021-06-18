<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $checkedUsers = [];

    public $selectAll = false;

    public $search;

    public $sortBy = 'Name';

    public $orderBy = 'desc';

    public function render()
    {
        $search = '%' . $this->search . '%';

        $sortBy = $this->sortBy;

        $orderBy = $this->orderBy;

        $users = User::whereRole('customer')
            ->where($sortBy, 'like', $search)
            ->orderBy('created_at', $orderBy)
            ->paginate(5);

        return view('livewire.users.users-index', compact('users'));
    }

    public function deleteChecked()
    {
        User::whereIn('id', $this->checkedUsers)
            ->delete();

        $this->checkedUsers = [];

        $this->selectAll = false;

        session()->flash('success', 'Records have been deleted successfully!');
        //dd($this->checkedUsers);
    }

    public function deleteRow($id)
    {
        User::findOrFail($id)->delete();

        $this->checkedUsers = array_diff($this->checkedUsers, [$id]);

        session()->flash('success', 'Record has been deleted successfully!');
    }

    public function updatedSelectAll($value)
    {
        $search = '%' . $this->search . '%';

        if ($value) {
            $this->checkedUsers = User::whereRole('user')->where('name', 'like', $search)->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checkedUsers = [];
        }
    }

    public function updatedCheckedUsers()
    {
        $this->selectAll = false;
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
}
