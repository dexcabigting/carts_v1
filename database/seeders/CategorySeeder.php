<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            [
                'ctgr_name' => 'Jersey',
                'ctgr_description' => 'Basketball uniforms consist of a jersey that features the number and last name of the player on the back, as well as shorts.',
                'created_At' => now(),
                'updated_at' => now(),
            ],
            [
                'ctgr_name' => 'T-Shirt',
                'ctgr_description' => 'T-Shirt is a style of fabric shirt named after the T shape of its body and sleeves.',
                'created_At' => now(),
                'updated_at' => now(),
            ],
        ];

        Category::insert($categories);
    }
}
