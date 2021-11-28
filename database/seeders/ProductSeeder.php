<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // ProductStock::factory()->count(10)->create();
        // Product::latest()->first()->id

        $path = 'images/products/';
        $extension = '.jpeg';

        $products = Product::factory()->count(3)->state(new Sequence(
                    fn ($sequence) => [
                        'prd_name' => 'Product '.$sequence->index + 1,]))
                    ->create();

        foreach($products as $product) {
            $variants = ProductVariant::factory()->count(2)
                            ->for($product)->state(new Sequence(
                                fn ($sequence) => ['prd_var_name' => 'Variant ' .$sequence->index + 1,
                                                    'front_view' => $path . 'Variant ' . $sequence->index + 1 . '-' . $product->prd_name . Str::random(10) . $extension,
                                                    'back_view' => $path . 'Variant ' . $sequence->index + 1 . '-' . $product->prd_name . Str::random(10) . $extension,
                                                    ]))
                            ->create();
        
            foreach($variants as $variant) {
                ProductStock::factory()->for($variant)->create();
            }
        }
    }
}
