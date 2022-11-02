<?php

use App\Models\Rack;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;
use App\Models\Item;

afterEach(function () {
    $this->artisan('migrate:fresh');
});

test('test Rack method getNameAttribute', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);

    // test
    $this->assertEquals('étagère 1', $rack->getNameAttribute());
});

test('test Rack method itemsOn', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item2 = Item::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $item  = Item::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    
    // test
    $this->assertEquals([1,2], $rack->itemsOn()->pluck('id')->toArray());
});

test('test Rack method itemsOnLevel', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item2 = Item::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $item  = Item::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);

    // test
    $this->assertEquals([2], $rack->itemsOnLevel(1)->pluck('id')->toArray());
});

test('test Rack method getRackLevelMax', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);
    $rack = Rack::create(['nb_level' => 7]);

    // test
    $this->assertEquals(7, Rack::getRackLevelMax([1,2,3]));
});



