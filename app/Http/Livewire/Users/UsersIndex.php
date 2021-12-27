<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use App\Models\Role;

use Exception;

use Illuminate\Support\Facades\DB;

class UsersIndex extends Component
{
    use WithPagination;

    public $checkedUsers;
    public $userId;
    public $selectAll = false;
    public $search;
    public $sortBy = 'role_id';
    public $orderBy = 'asc';
    public $createModal = false;
    public $editModal = false;
    public $deleteModal = false;
    public $query = 'users';
    public $disabled = 'disabled';

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

    public function callEvent()
    {
        $this->dispatchBrowserEvent('exceptionAlert');
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
            ->where('name', 'like', $search)
            ->where('id', '!=',  auth()->user()->id)
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
                ->where('role_id', Role::where('role', '=', 'Customer')->first()->id)
                ->where($sortBy, 'like', $search)
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

    public function updatingQuery()
    {
        $this->resetPage();

        $this->checkedUsers = [];

        $this->selectAll = false;
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
        $this->reset(['search', 'sortBy', 'orderBy', 'query']);
    }

    public function restoreUser($id)
    {
        try {
            DB::transaction(function() use($id) {
                $user = User::onlyTrashed()->findOrFail($id);

                $user->restore();

                $user->userAddresses()->onlyTrashed()->restore();

                $user->likes()->onlyTrashed()->restore();

                $user->product_variant_comments()->onlyTrashed()->restore();

                $carts = $user->carts()->onlyTrashed();
                    
                $carts->each(function ($cart) {
                    $cart->restore();

                    $cart->cart_items()->onlyTrashed()->restore();
                });

                $orders = $user->orders()->onlyTrashed();

                $orders->each(function ($order) {
                    $order->restore();

                    $orderVariants = $order->order_variants()->onlyTrashed();

                    $orderVariants->each(function ($orderVariant) {
                        $orderVariant->restore();

                        $orderItems = $orderVariant->order_items()->onlyTrashed();

                        $orderItems->each(function ($orderItem) {
                            $orderItem->restore();
                        });
                    });
                });

                $this->emit('unsetCheckedUsers', [$id]);

                $this->emit('cleanse');
            });
        } catch(Exception $error) {
            $this->dispatchBrowserEvent('exceptionAlert', ['error' => $error]);
        }
    }

    public function restoreUsers()
    {
        try {
            DB::transaction(function() {
                $userIds = $this->checked_keys;

                $users = User::onlyTrashed()->whereIn('id', $userIds)->get();

                $users->each(function ($user) {
                    $user->restore();

                    $user->userAddresses()->onlyTrashed()->restore();

                    $user->likes()->onlyTrashed()->restore();

                    $user->product_variant_comments()->onlyTrashed()->restore();

                    $carts = $user->carts()->onlyTrashed();
                    
                    $carts->each(function ($cart) {
                        $cart->restore();

                        $cart->cart_items()->onlyTrashed()->restore();
                    });

                    $orders = $user->orders()->onlyTrashed();

                    $orders->each(function ($order) {
                        $order->restore();

                        $orderVariants = $order->order_variants()->onlyTrashed();

                        $orderVariants->each(function ($orderVariant) {
                            $orderVariant->restore();

                            $orderItems = $orderVariant->order_items()->onlyTrashed();

                            $orderItems->each(function ($orderItem) {
                                $orderItem->restore();
                            });
                        });
                    });
                }); 

                $this->emit('unsetCheckedUsers', $userIds);

                $this->emit('cleanse');
            });
        } catch(Exception $error) {
            $this->dispatchBrowserEvent('exceptionAlert', ['error' => $error]);
        }
    }
}
