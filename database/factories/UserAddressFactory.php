<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'region' => 'Region III (Central Luzon)',
            'province' => 'Pampanga',
            'city' => 'Mabalacat City',
            'barangay' => 'Paralayunan',
            'home_address' => '187 ' . $this->faker->sentence(2),
            'is_main_address' => 1,
        ];
    }

    public function adminAddress()
    {
        return $this->state(function (array $attributes) {
            return [
                'region' => 'Region III (Central Luzon)',
                'province' => 'Pampanga',
                'city' => 'Mabalacat City',
                'barangay' => 'Mabiga',
                'home_address' => 'MacArthur Highway',
                'is_main_address' => 1,
            ];
        });
    }

    public function defaultUserAddress()
    {
        return $this->state(function (array $attributes) {
            return [
                'region' => 'Region III (Central Luzon)',
                'province' => 'Pampanga',
                'city' => 'Mabalacat City',
                'barangay' => 'San Francisco',
                'home_address' => '87000 Jollibee Delivery',
                'is_main_address' => 1,
            ];
        });
    }
}
