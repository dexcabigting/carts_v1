<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $product_images = Storage::allFiles('public/images/products');

        $product_models = Storage::allFiles('public/images/models');

        Storage::delete($product_images);

        Storage::delete($product_models);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            Category::class,
            Fabric::class,
        ]);
    }
}
