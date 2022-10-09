<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $faker = Faker\Factory::create();
        return [
            'quantity' => fake()->numberBetween(0,100),
            'price' => fake()->numberBetween(1,10000),
            'model' => fake()->unique()->bothify('????-####'),
            'comment' => fake()->sentence()
        ];
    }
}
