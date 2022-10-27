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
            'price' => fake()->randomFloat(2, 1, 100),
            'comment' => fake()->sentence(),
            'serial_number' => fake()->regexify('^[0-9A-Za-z]{8,12}$'),
        ];
    }
}
