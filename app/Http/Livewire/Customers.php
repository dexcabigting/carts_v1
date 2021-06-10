<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;

    public $checkedCustomers = [];

    public $selectAll = false;

    public function render()
    {
        $customers = User::whereRole('customer')->paginate(5);

        return view('livewire.customers', compact('customers'));
    }

    public function deleteChecked()
    {
        dd($this->checkedCustomers);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checkedCustomers = User::whereRole('customer')->pluck('id');
        } else {
            $this->checkedCustomers = [];
        }
    }
}
