<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use Livewire\WithPagination;

// use App\Models\Order;
use App\Models\Category;
use App\Models\Fabric;
use App\Models\Product;
use App\Models\OrderVariant;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class SalesIndex extends Component
{
    use WithPagination;

    public $categoryId = '%%';
    public $fabricId = '%%';
    public $productId = '%%';
    public $productVariantId = '%%';
    public $categories;
    public $fabrics;
    public $sortDirection = 'asc';
    public $startDate = '';
    public $endDate = '';
    
    // public $products;

    public function mount()
    {
        $this->categories = Category::select('id', 'ctgr_name')->get()->toArray();

        $this->fabrics = Fabric::select('id', 'fab_name')->get()->toArray();

        $this->resetDates();
    }

    public function render()
    {
        // dd($this->sales->get()->toArray());
        $sales = $this->sales->paginate(10);

        $products = $this->products->get()->toArray();

        return view('livewire.sales.sales-index', compact('sales', 'products'))->layout('layouts.app');
    }

    public function getSalesProperty()
    {
        return OrderVariant::select('product_variant_id', 
                            DB::raw('sum(amount) as amount'), 
                            DB::raw('count(*) as quantity'),
                            DB::raw('min(created_at) as earliest'),
                            DB::raw('max(created_at) as latest'))
                    ->groupBy('product_variant_id')
                    ->orderBy('amount', $this->sortDirection)
                    ->with(['product_variant' => function ($query) {
                            $query->select('id', 'product_id', 'prd_var_name')
                                ->with(['product' => function ($query) {
                                            $query->select('id', 'prd_name', 'category_id', 'fabric_id')
                                                ->with(['category:id,ctgr_name', 'fabric:id,fab_name']);
                                        }]);
                        }])
                    ->whereHas('product_variant', function ($query) {
                            $query->whereHas('product', function ($query) {
                                    $query->where('category_id', 'like', $this->categoryId)
                                        ->where('fabric_id', 'like', $this->fabricId);
                                    })
                                ->where('product_id', 'like', $this->productId);
                        })
                    ->where('product_variant_id', 'like', $this->productVariantId)
                    ->where('created_at', '>=', $this->startDate)
                    ->where('created_at', '<=', Carbon::parse($this->endDate)->addDay(1)->toDateString());                    
    }

    public function getProductsProperty()
    {
        return Product::select('id', 'prd_name')
                ->where('category_id', 'like', $this->categoryId)
                ->where('fabric_id', 'like', $this->fabricId)
                ->whereHas('product_variants', function ($query) {
                    $query->whereHas('order_variants');   
                });
    }

    public function resetFilter()
    {
        $this->reset(['categoryId', 'fabricId', 'productId']);

        $this->resetDates();
    }

    private function resetDates()
    {
        $start = OrderVariant::oldest()->first('created_at')->toArray();

        $end = OrderVariant::latest()->first('created_at')->toArray();

        if(empty($start) && empty($end)) {
            $this->startDate = now()->toDateString();

            $this->endDate = now()->toDateString();
        } else {
            $this->startDate = Carbon::parse($start['created_at'])->toDateString();

            $this->endDate = Carbon::parse($end['created_at'])->toDateString();
        }
        // dd($this->startDate,  $this->endDate);
    }
}
