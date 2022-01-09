<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\TshirtDetails;
use App\Models\User;
use Livewire\WithPagination;

class ProductsCustomerList extends Component
{
    public function render()
    {
        $tshirt_details = TshirtDetails::all();

        $userIds = $tshirt_details->pluck('user_id')->toArray();

        $userNames = User::where('id', $userIds)->select('id', 'name')->get()->toArray();
        // dd($userNames);

        return view('livewire.products.products-customer-list', compact('tshirt_details', 'userNames'));
    }
}
