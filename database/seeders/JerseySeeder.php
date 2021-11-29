<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductStock;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class JerseySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'images/products/';
        $extension = '.jpg';
        $category_id = Category::where('ctgr_name', 'Jersey')->first()->id;

        for($i = 1; $i <= 6; $i++) {
            $front_filename = $path . 'Variant 1-EJ EZON JERSEY '.$i.'-' . Str::random(10) . $extension;
            $back_filename = $path . 'Variant 1-EJ EZON JERSEY '.$i.'-' . Str::random(10) . $extension;

            Storage::copy('public/JERSEY TEMPLATES/TEMPLATE'.$i.'/FRONT.jpg', 'public/' .  $front_filename);
            Storage::copy('public/JERSEY TEMPLATES/TEMPLATE'.$i.'/BACK.jpg', 'public/' .  $back_filename);

            $products = Product::factory()->state([
                'category_id' => $category_id,
                'prd_name' => 'EJ EZON JERSEY '.$i,
            ])->has(
                ProductVariant::factory()->state([
                    'prd_var_name' => 'Variant ' .$i,
                    'front_view' => $front_filename,
                    'back_view' => $back_filename,
                ])->has(ProductStock::factory(), 'product_stock'), 'product_variants'
            )->create();
        }
    }
}
