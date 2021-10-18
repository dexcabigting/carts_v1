<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\TshirtDetails;
use Livewire\WithPagination;

class ProductsCustomerList extends Component
{
    public function render()
    {
        $tshirt_details = TshirtDetails::all();;

        return view('livewire.products.products-customer-list')->with('tshirt_details', $tshirt_details);;
    }
}
