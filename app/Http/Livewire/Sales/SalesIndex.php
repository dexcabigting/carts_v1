<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use Livewire\WithPagination;

// use App\Models\Order;
use App\Models\Category;
use App\Models\OrderVariant;

use Illuminate\Support\Facades\DB;


class SalesIndex extends Component
{
    use WithPagination;

    public $categoryId = '%%';
    public $fabricId = '%%';
    public $productId = '%%';
    public $productVariantId = '%%';
    public $categories;

    public function mount()
    {
        $this->categories = Category::select('id', 'ctgr_name')->get()->toArray();

        // dd($this->categories);
    }

    public function render()
    {
        // dd($this->sales->get()->toArray());
        $sales = $this->sales->paginate(10);
        return view('livewire.sales.sales-index', compact('sales'))->layout('layouts.app');
    }

    public function getSalesProperty()
    {
        return OrderVariant::select('product_variant_id', 
                            DB::raw('sum(amount) as amount'), 
                            DB::raw('count(*) as quantity'),
                            DB::raw('min(created_at) as earliest'),
                            DB::raw('max(created_at) as latest'))
                    ->groupBy('product_variant_id')
                    ->with(['product_variant' => function ($query) {
                            $query->select('id', 'product_id', 'prd_var_name');
                        }])
                    ->whereHas('product_variant', function ($query) {
                            $query->whereHas('product', function ($query) {
                                    $query->where('category_id', 'like', $this->categoryId)
                                        ->where('fabric_id', 'like', $this->fabricId);
                                    })
                                ->where('product_id', 'like', $this->productId);
                        })
                    ->where('product_variant_id', 'like', $this->productVariantId);                    
    }

    public function resetFilter()
    {
        $this->reset(['categoryId']);
    }
}
