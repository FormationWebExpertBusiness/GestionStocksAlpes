<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommonProduct>
 */
class CommonProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'model' => fake()->unique()->bothify('????-####'),
            'favorite' => fake()->boolean(),
            'category_id' => fake()->numberBetween(1,Category::all()->count()),
            'brand_id' => fake()->numberBetween(1, Brand::all()->count()),
        ];
    }
}
