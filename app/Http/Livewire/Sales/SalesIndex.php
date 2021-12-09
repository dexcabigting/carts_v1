<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderVariant;
use Illuminate\Support\Facades\DB;

class SalesIndex extends Component
{
    public function render()
    {
        dd($this->sales);
        return view('livewire.sales.sales-index')->layout('layouts.app');
    }

    public function getSalesProperty()
    {
        return OrderVariant::select('product_variant_id', 
                                    DB::raw('sum(amount) as amount'), 
                                    DB::raw('count(*) as variant'),
                                    DB::raw('min(created_at) as earliest'),
                                    DB::raw('max(created_at) as latest'))
                            ->groupBy('product_variant_id')
                            ->with(['product_variant' => function ($query) {
                                $query->select('id', 'product_id', 'prd_var_name')
                                    ->with(['product' => function ($query) {
                                        $query->select('id', 'prd_name');
                                    }]);
                            }])
                            ->whereDate('created_at', '>=', '2021-12-06')
                            ->whereDate('created_at', '<=', '2021-12-07')
                            ->get()->toArray();
    }
}
