<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRand();
    }

    private function createRand()
    {
        $NDcategory = \App\Models\Category::create([
            'name' => 'Non défini',
        ]);
        
        \App\Models\Category::factory()->count(8)->create()->merge([$NDcategory]);
    }

    private function createCustom()
    {
        \App\Models\Category::create([
            'name' => 'Switch',
        ]);

        \App\Models\Category::create([
            'name' => 'Lampe',
        ]);

        \App\Models\Category::create([
            'name' => 'FireWall',
        ]);

        \App\Models\Category::create([
            'name' => 'Routeur',
        ]);

        \App\Models\Category::create([
            'name' => 'Caméra',
        ]);

        \App\Models\Category::create([
            'name' => 'Lecteur de badge',
        ]);

        \App\Models\Category::create([
            'name' => 'Téléphone',
        ]);

        \App\Models\Category::create([
            'name' => 'Cable',
        ]);
    }
}
