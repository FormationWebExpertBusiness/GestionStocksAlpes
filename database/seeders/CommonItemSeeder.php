<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Brand;

class CommonItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            \App\Models\CommonItem::factory()->create([
                'category_id' => fake()->numberBetween(1,Category::all()->count()),
                'brand_id' => fake()->numberBetween(1, Brand::all()->count()),
            ]);
        }
    }
}
