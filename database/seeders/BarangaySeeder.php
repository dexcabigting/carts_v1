<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Yajra\Address\Entities\Barangay;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Barangay::create([
            'code' => 00,
            'name' => 'N/A',
            'region_id' => 00,
            'province_id' => 00,
            'city_id' => 00
        ]);
    }
}
