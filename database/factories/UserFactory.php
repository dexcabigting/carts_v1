<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phone' => null,
            'otp' => null,
            'password' => Hash::make('Capstone2'), // password
            'remember_token' => null, //Str::random(10),
            'role_id' => rand(2, 3),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function isAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'phone' => '639392698072',
                'otp' => null,
                'password' => Hash::make('Capstone2'), // password
                'remember_token' => null, //Str::random(10),
                'role_id' => 1,
                ];
        });
    }

    public function isUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'User',
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'phone' => '639392862206',
                'otp' => null,
                'password' => Hash::make('Capstone2'), // password
                'remember_token' => null, //Str::random(10),
                'role_id' => 3,
                ];
        });
    }
}
