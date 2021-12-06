<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Fabric;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;

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
            'category_id' => Category::all()->random(),
            'fabric_id' => Fabric::all()->random(),
            'prd_name' => $this->faker->unique()->word(),
            'prd_description' => $this->faker->text(50),
            'prd_price' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 750.00, $max = 1000.00),
        ];
    }
}
