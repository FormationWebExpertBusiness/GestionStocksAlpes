<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->createRand();
        $this->createCustom();
    }

    private function createRand()
    {
        $NDbrand = \App\Models\Brand::create([
            'name' => 'Non défini',
        ]);

        \App\Models\Brand::factory()->count(10)->create();//->merge([$NDbrand]);
    }

    private function createCustom()
    {
        \App\Models\Brand::create([
            'name' => 'HP',
        ]);

        \App\Models\Brand::create([
            'name' => 'tp-link',
        ]);

        \App\Models\Brand::create([
            'name' => 'Alpes Network',
        ]);

        \App\Models\Brand::create([
            'name' => 'Makita',
        ]);

        \App\Models\Brand::create([
            'name' => 'LinkSys',
        ]);

        \App\Models\Brand::create([
            'name' => 'Asus',
        ]);

        \App\Models\Brand::create([
            'name' => 'Prysmian Group',
        ]);
    }
}
