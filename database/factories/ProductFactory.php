<?php

namespace Database\Factories;

use App\Models\CommonProduct;
use App\Models\Rack;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = [
            [
                'username' => 'test',
                'password' => 'test',
            ],
            [
                'username' => 'testt',
                'password' => 'testt',
            ],
        ];

        Auth::attempt($users[fake()->numberBetween(0, count($users)-1)]);

        $rack = Rack::inRandomOrder()->first();
        return [
            'price' => fake()->randomFloat(2, 1, 100),
            'comment' => fake()->sentence(),
            'serial_number' => fake()->regexify('^[0-9A-Za-z]{8,12}$'),
            'rack_id' => $rack->id,
            'rack_level' => fake()->numberBetween(1,$rack->nb_level),
            'common_id' => fake()->numberBetween(1, CommonProduct::count()),
        ];

        Auth::logout();
    }
}
