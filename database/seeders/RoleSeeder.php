<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role' => 'Admin',
            ],
            [
                'role' => 'Courier',
            ],
            [
                'role' => 'Customer',
            ],
        ];

        Role::insert($roles);
    }
}
