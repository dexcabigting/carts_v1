<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class CustomersTable extends Component
{
    use WithPagination;

    public $checkedCustomers = [];

    public $selectAll = false;

    public $search;

    public $sortBy = 'Name';

    public function render()
    {
        $search = '%' . $this->search . '%';

        $sortBy = $this->sortBy;

        $customers = User::whereRole('customer')->where($sortBy, 'like', $search)->paginate(5);

        return view('livewire.customers-table', compact('customers'));
    }

    public function deleteChecked()
    {
        User::whereIn('id', $this->checkedCustomers)
            ->delete();

        $this->checkedCustomers = [];

        $this->selectAll = false;

        session()->flash('success', 'Customer deleted successfully!');
        //dd($this->checkedCustomers);
    }

    public function updatedSelectAll($value)
    {
        $search = '%' . $this->search . '%';

        if ($value) {
            $this->checkedCustomers = User::whereRole('customer')->where('name', 'like', $search)->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checkedCustomers = [];
        }
    }

    public function updatedCheckedCustomers()
    {
        $this->selectAll = false;
    }

    public function updatedSearch()
    {
        if(is_array($this->checkedCustomers)) {
            $this->checkedCustomers = [];

            $this->selectAll = false;
        }
    }
}
