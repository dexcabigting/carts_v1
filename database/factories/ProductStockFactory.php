<?php

namespace Database\Factories;

use App\Models\ProductStock;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductStockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductStock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            '2XS' => $this->faker->numberBetween(10, 100),
            'XS' => $this->faker->numberBetween(10, 100),
            'S' => $this->faker->numberBetween(10, 100),
            'M' => $this->faker->numberBetween(10, 100),
            'L' => $this->faker->numberBetween(10, 100),
            'XL' => $this->faker->numberBetween(10, 100),
            '2XL' => $this->faker->numberBetween(10, 100),
        ];
    }
}
