<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        // $path = pathinfo('images/products/plain_jersey.jpg');

        // $imagePath = $path['dirname'] . '/' . 'plain_jersey' . Str::random(30) . '.' . $path['extension'];

        // Storage::copy('public/images/dummies/plain_jersey.jpg', 'public/' . $imagePath);

        Storage::deleteDirectory('public/images');
        
        $path = 'images/products/';
        $extension = '.jpg';

        for($i = 1; $i <= 6; $i++) {
            $front_filename = $path . 'Variant 1-EJ EZON JERSEY '.$i.'-' . Str::random(10) . $extension;
            $back_filename = $path . 'Variant 1-EJ EZON JERSEY '.$i.'-' . Str::random(10) . $extension;

            Storage::copy('public/JERSEY TEMPLATES/TEMPLATE'.$i.'/FRONT.jpg', 'public/' .  $front_filename);
            Storage::copy('public/JERSEY TEMPLATES/TEMPLATE'.$i.'/BACK.jpg', 'public/' .  $back_filename);

            $products = Product::factory()->state([
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
