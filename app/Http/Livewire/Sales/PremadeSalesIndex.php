<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use Livewire\WithPagination;

// use App\Models\Order;
use App\Models\Category;
use App\Models\Fabric;
use App\Models\Product;
use App\Models\OrderVariant;
use App\Models\OrderItem;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class PremadeSalesIndex extends Component
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

        return view('livewire.sales.premade-sales-index', compact('sales', 'products'));
    }

    public function getSalesProperty()
    {
        return OrderVariant::select('product_variant_id', 
                            DB::raw('min(created_at) as earliest'),
                            DB::raw('max(created_at) as latest'))
                    ->addSelect([
                        "amount" => OrderItem::select(DB::raw('sum(amount) as amount'))
                            ->join('order_variants', 'order_variants.id', '=', 'order_variant_id')
                            ->groupBy('product_variant_id')
                            ->limit(1),
                        "quantity" => OrderItem::select(DB::raw('count(*) as quantity'))
                            ->join('order_variants', 'order_variants.id', '=', 'order_variant_id')
                            ->groupBy('product_variant_id')
                            ->limit(1)
                    ])
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
                    ->whereHas('order', function ($query) {
                        $query->where(function ($query) {
                            $query->where('status', '!=', 'Rejected')
                                ->where('status', '!=', 'Pending');
                        });
                    })
                    ->where('product_variant_id', 'like', $this->productVariantId)
                    ->where('created_at', '>=', Carbon::parse($this->startDate)->toDateString())
                    ->where('created_at', '<=', Carbon::parse($this->endDate)->addDay(1)->toDateString());                    
    }

    public function getProductsProperty()
    {
        return Product::select('id', 'prd_name')
                ->where('category_id', 'like', $this->categoryId)
                ->where('fabric_id', 'like', $this->fabricId)
                ->whereHas('product_variants', function ($query) {
                    $query->whereHas('order_variants', function ($query) {
                        $query->whereHas('order', function ($query) {
                            $query->where(function ($query) {
                                $query->where('status', '!=', 'Rejected')
                                    ->orWhere('status', '!=', 'Pending');
                            });
                        });
                    });   
                });
    }

    public function resetFilter()
    {
        $this->reset(['categoryId', 'fabricId', 'productId']);

        $this->resetDates();
    }

    private function resetDates()
    {
        if(count($this->sales->get()) > 0) {
            $start = OrderVariant::oldest()->first('created_at')->toArray();

            $end = OrderVariant::latest()->first('created_at')->toArray();

            $this->startDate = Carbon::parse($start['created_at'])->toDateString();

            $this->endDate = Carbon::parse($end['created_at'])->toDateString();
        } else {
            $this->startDate = now()->toDateString();

            $this->endDate = now()->toDateString();
        }


        // if(empty($start) && empty($end)) {
        //     $this->startDate = now()->toDateString();

        //     $this->endDate = now()->toDateString();
        // } else {
        //     $this->startDate = Carbon::parse($start['created_at'])->toDateString();

        //     $this->endDate = Carbon::parse($end['created_at'])->toDateString();
        // }
        // dd($this->startDate,  $this->endDate);
    }
}
