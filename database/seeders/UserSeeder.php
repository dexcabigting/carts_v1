<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserAddress;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(1)->isAdmin()->create();  

        UserAddress::factory(1)
            ->adminAddress()
            ->for(User::factory()->isAdmin())
            ->create();

        UserAddress::factory(1)
            ->defaultUserAddress()
            ->for(User::factory()->isDefaultUser())
            ->create();

        User::factory(10)
            ->has(UserAddress::factory())
            ->create();
    }
}
