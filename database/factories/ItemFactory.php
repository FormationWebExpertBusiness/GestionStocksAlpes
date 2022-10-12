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
        return [
            'quantity' => fake()->numberBetween(0,50),
            'price' => fake()->numberBetween(1,1000),
            'model' => fake()->unique()->bothify('????-####'),
            'comment' => fake()->sentence()
        ];
    }
}
