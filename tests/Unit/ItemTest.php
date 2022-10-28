<?php

use App\Models\Rack;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;
use App\Models\Item;

afterEach(function () {
    $this->artisan('migrate:fresh');
});

test('test Item method rack', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item2 = Item::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    // test
    $this->assertEquals([1], $item2->rack()->pluck('id')->toArray());
});
