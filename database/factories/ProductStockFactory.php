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
            'product_id' => Product::factory()->create()->id,
            'xxsmall' => $this->faker->numberBetween(10, 100),
            'xsmall' => $this->faker->numberBetween(10, 100),
            'small' => $this->faker->numberBetween(10, 100),
            'medium' => $this->faker->numberBetween(10, 100),
            'large' => $this->faker->numberBetween(10, 100),
            'xlarge' => $this->faker->numberBetween(10, 100),
            'xxlarge' => $this->faker->numberBetween(10, 100),
        ];
    }
}
