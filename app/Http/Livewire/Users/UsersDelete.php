<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use App\Models\User;

use Exception;

use Illuminate\Support\Facades\DB;

class UsersDelete extends Component
{
    public $users = [];

    public $promptDelete = 1;
    public $promptDeleted = 0;

    public function mount(...$id)
    {
        $this->users = collect($id)->flatten()->toArray();
    }

    public function render()
    {
        return view('livewire.users.users-delete');
    }

    public function deleteUsers()
    {
        try {
            DB::transaction(function() {
                if(count($this->users) == 1) {
                    $flash = 'User has been successfully deleted!';

                    $user = User::findOrfail($this->users[0]);
                    $user->delete();
                } else {
                    $flash = 'Users have been successfully deleted!';

                    $users = User::whereIn('id', $this->users)->get();
                    $users->each->delete();
                }
                    
                $this->emitUp('unsetCheckedUsers', $this->users);

                $this->emitUp('cleanse');

                $this->emitUp('refreshParent');

                session()->flash('success', $flash);

                $this->users = [];

                $this->promptDelete = 0;

                $this->promptDeleted = 1;
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function closeDeleteModal()
    {
        $this->dispatchBrowserEvent('deleteModalDisplayNone');

        $this->emitUp('closeDeleteModal');
    }
}
