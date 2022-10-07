<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // USER
        \App\Models\User::create([
            'username' => 'test',
            'password' => Hash::make('test')
        ]);

        // BRAND
        $brands = [];
        
        $brands[] = \App\Models\Brand::create([
            'name' => 'Non défini',
        ]);

        $brands[] = \App\Models\Brand::create([
            'name' => 'HP',
        ]);

        $brands[] = \App\Models\Brand::create([
            'name' => 'tp-link',
        ]);

        $brands[] = \App\Models\Brand::create([
            'name' => 'Alpes Network',
        ]);

        $brands[] = \App\Models\Brand::create([
            'name' => 'Makita',
        ]);

        $brands[] = \App\Models\Brand::create([
            'name' => 'LinkSys',
        ]);

        $brands[] = \App\Models\Brand::create([
            'name' => 'Asus',
        ]);

        $brands[] = \App\Models\Brand::create([
            'name' => 'Prysmian Group',
        ]);

        // CATEGORY

        $categories = [];

        $categories[] = \App\Models\Category::create([
            'name' => 'Non défini',
        ])->brands()->saveMany($brands);

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

        // ITEM

        \App\Models\Item::create([
            'quantity' => 7,
            'category_id' => 4,
            'price' => 385,
            'brand_id' => 4,
            'model' => 'ALPN-01'
        ]);

        \App\Models\Item::create([
            'quantity' => 1,
            'category_id' => 5,
            'price' => 125,
            'brand_id' => 7,
            'model' => 'AX6000',
            'comment' => 'Routeur Wifi 6',
        ]);

        \App\Models\Item::create([
            'quantity' => 2,
            'category_id' => 3,
            'price' => 74,
            'brand_id' => 5,
            'model' => 'GGDSCF53',
            'comment' => 'Petit Projecteur',
        ]);

        \App\Models\Item::create([
            'quantity' => 6,
            'category_id' => 8,
            'price' => 120,
            'brand_id' => 6,
            'model' => 'G5436-GG',
            'comment' => 'Poste Téléphonique Fixe',
        ]);

        \App\Models\Item::create([
            'quantity' => 6,
            'category_id' => 8,
            'price' => 150,
            'brand_id' => 6,
            'model' => 'SPA962',
            'comment' => 'Poste Téléphonique Fixe',
        ]);

        \App\Models\Item::create([
            'quantity' => 10,
            'category_id' => 2,
            'brand_id' => 2,
            'price' => 1000,
            'model' => 'J9147A',
            'comment' => 'Switch 48 ports',
        ]);

        \App\Models\Item::create([
            'quantity' => 2,
            'price' => 120,
            'category_id' => 2,
            'brand_id' => 3,
            'model' => 'TL-SG1016',
            'comment' => 'Switch 16 ports',
        ]);

        \App\Models\Item::create([
            'quantity' => 4500,
            'category_id' => 9,
            'price' => 270,
            'brand_id' => 8,
            'unit' => 'm',
            'currency' => 'USD',
            'model' => 'L1084-1',
            'comment' => 'Fibre optique',
        ]);

        \App\Models\Item::create([
            'quantity' => 36,
            'category_id' => 2,
            'price' => 360,
            'brand_id' => 8,
            'currency' => 'EUR',
            'model' => 'DNCD-Y8D',
        ]);

        \App\Models\Item::create([
            'quantity' => 13,
            'category_id' => 6,
            'price' => 180,
            'brand_id' => 7,
            'currency' => 'EUR',
            'model' => 'VIDCAM-6',
        ]);

        \App\Models\Item::create([
            'quantity' => 36,
            'category_id' => 6,
            'price' => 360,
            'brand_id' => 8,
            'currency' => 'EUR',
            'model' => 'DNCD-E9H',
        ]);

        \App\Models\Item::create([
            'quantity' => 36,
            'category_id' => 6,
            'price' => 360,
            'brand_id' => 1,
            'currency' => 'EUR',
            'model' => '3789743',
        ]);
    }
}
