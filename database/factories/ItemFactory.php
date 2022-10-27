<?php

namespace Database\Factories;

use App\Models\CommonItem;
use App\Models\Rack;

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
        $rack = Rack::inRandomOrder()->first();
        return [
            'price' => fake()->randomFloat(2, 1, 100),
            'comment' => fake()->sentence(),
            'serial_number' => fake()->regexify('^[0-9A-Za-z]{8,12}$'),
            'rack_id' => $rack->id,
            'rack_level' => fake()->numberBetween(1,$rack->nb_level),
            'common_id' => fake()->numberBetween(1, CommonItem::count()),
        ];
    }
}
