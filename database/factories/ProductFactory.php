<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prd_name' => $this->faker->word(),
            'prd_description' => $this->faker->text(50),
            'prd_price' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 750.00, $max = 1000.00),
        ];
    }
}
