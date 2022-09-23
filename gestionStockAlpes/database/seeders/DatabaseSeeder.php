<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Brand::create([
            'name' => 'hp',
        ]);

        \App\Models\Brand::create([
            'name' => 'cisco',
        ]);

        \App\Models\Category::create([
            'name' => 'switch',
        ]);

        \App\Models\Category::create([
            'name' => 'cable',
        ]);

        \App\Models\Item::create([
            'quantity' => 3,
            'category_id' => 1,
            'brand_id' => 1,
            'price' => 100,
            'model' => '7xpkz3',
            'comment' => 'switch 12 prises',
        ]);

        \App\Models\Item::create([
            'quantity' => 5,
            'price' => 25,
            'category_id' => 2,
            'brand_id' => 2,
            'model' => 'hjfh87hdh',
            'comment' => 'cable rj45',
        ]);

        \App\Models\Item::create([
            'quantity' => 25,
            'category_id' => 2,
            'price' => 30,
            'brand_id' => 2,
            'unit' => 'm',
            'model' => 'kvkele0945',
            'comment' => 'fibre optique',
        ]);
    }
}
