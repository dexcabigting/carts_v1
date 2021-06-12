<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class CustomersIndex extends Component
{
    use WithPagination;

    public $checkedCustomers = [];

    public $selectAll = false;

    public function render()
    {
        $customers = User::whereRole('customer')->paginate(5);

        return view('livewire.customers-index', compact('customers'));
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
        if ($value) {
            $this->checkedCustomers = User::whereRole('customer')->pluck('id')->map(fn ($item) => (string) $item);
        } else {
            $this->checkedCustomers = [];
        }
    }

    public function updatedCheckedCustomers()
    {
        $this->selectAll = false;
    }
}
