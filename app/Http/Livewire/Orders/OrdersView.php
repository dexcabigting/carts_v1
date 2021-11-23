<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;

class OrdersView extends Component
{
    public function render()
    {
        return view('livewire.orders.orders-view');
    }

    public function closeViewModal()
    {
        $this->dispatchBrowserEvent('viewModalDisplayNone');
        
        $this->emitUp('closeViewModal');
    }
}
