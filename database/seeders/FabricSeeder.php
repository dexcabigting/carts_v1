<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fabric;

class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $fabrics = [
            [
                'fab_name' => 'Spandex',
                'fab_description' => 'Spandex is a synthetic fabric that is prized for its elasticity.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fab_name' => 'Sublimax',
                'fab_description' => 'Sublimax is designed for the thermic transfer from sublimated paper to fabric',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fab_name' => 'Neoprene',
                'fab_description' => 'Neoprene fabric is created through a complex chemical process known as free radical emulsion polymerization.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fab_name' => 'Sportsmax',
                'fab_description' => 'Sportsmax sells best for making shirts for running or any sports event.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fab_name' => 'Polydex',
                'fab_description' => 'Polydex has a smooth and absorbent feature that makes it cooler than cotton shirts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fab_name' => 'Ribstop',
                'fab_description' => 'Ripstop fabrics are woven fabrics, often made of nylon, using a special reinforcing technique that makes them resistant to tearing and ripping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fab_name' => 'Latex',
                'fab_description' => 'The stretchy quality of latex and rubber is very desired for some articles of clothing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fab_name' => 'Micro Shiny',
                'fab_description' => 'Micro Shiny is used for jerseys available in many colors.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fab_name' => '1x1 Lining',
                'fab_description' => '1x1 lining has lightweight and soft texture and mainly used in the athletic attires such as shorts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Fabric::insert($fabrics);
    }
}
