<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)->isAdmin()->create();

        User::factory()->count(1)->isUser()->create();

        // User::factory()->count(10)->unverified()->create();

        User::factory()->count(10)->create();
    }
}
