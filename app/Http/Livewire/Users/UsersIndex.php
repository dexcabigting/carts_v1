<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $checkedUsers;
    public $selectAll = false;
    public $search;
    public $sortBy = 'Name';
    public $orderBy = 'desc';
    public $roles = [2, 3];

    public function mount()
    {
        $this->checkedUsers = [];
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

        return User::with([
            'role' => function ($query) {
                $query->whereIn('id', $this->roles);
            }
        ])      
            ->whereIn('role_id', $this->roles)
            ->where($sortBy, 'like', $search)
            ->orderBy('created_at', $orderBy);
    }

    public function deleteChecked()
    {
        $this->checkedUsers = array_keys($this->checkedUsers);
        
        User::whereIn('id', $this->checkedUsers)->delete();

        $this->checkedUsers = [];

        $this->selectAll = false;

        session()->flash('success', 'Records have been deleted successfully!');
        
        // dd($this->checkedUsers);
    }

    public function deleteRow($id)
    {
        if (is_array($this->checkedUsers)) {
            unset($this->checkedUsers[$id]);
        }

        User::findOrFail($id)->delete();

        $this->checkedUsers = array_diff($this->checkedUsers, [$id]);

        session()->flash('success', 'Record has been deleted successfully!');
        
        //dd($this->checkedUsers);
    }

    public function updatedSelectAll($value)
    {
        $search = '%' . $this->search . '%';

        if ($value) {
            $this->checkedUsers = User::whereIn('role_id', $this->roles)
                ->where('name', 'like', $search)
                ->pluck('id')
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
}
