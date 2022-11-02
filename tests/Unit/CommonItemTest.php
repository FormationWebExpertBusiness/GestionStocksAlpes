<?php

use App\Models\Rack;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;
use App\Models\Item;

afterEach(function () {
    $this->artisan('migrate:fresh');
});

test('test CommonItem method items', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item1 = Item::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $item2 = Item::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 5, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals([1,2,3], $commonItem->items()->pluck('id')->toArray());
});

test('test CommonItem method getQuantityAttribute', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item1 = Item::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $item2 = Item::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 5, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals(3, $commonItem->getQuantityAttribute());
});

test('test CommonItem method getTotalPriceAttribute', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item1 = Item::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals(18, $commonItem->getTotalPriceAttribute());
});

test('test CommonItem method unitPrice', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals(5, $commonItem->unitPrice());
});

test('test CommonItem method brand', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    // test
    $this->assertEquals([1], $commonItem->brand()->pluck('id')->toArray());
});

test('test CommonItem method category', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    // test
    $this->assertEquals([1], $commonItem->category()->pluck('id')->toArray());
});

test('test CommonItem method itemsOnRack', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 3, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 3, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);


    // test
    $this->expect([5,6])->toBe($commonItem->itemsOnRack([2])->pluck('id')->toArray());
    $this->expect([1,3,4])->toBe($commonItem->itemsOnRack([1], [3,4])->pluck('id')->toArray());
});

test('test CommonItem method quantityOnRack', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 3, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 3, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);


    // test
    $this->expect(2)->toBe($commonItem->quantityOnRack([2]));
    $this->expect(3)->toBe($commonItem->quantityOnRack([1],[3,4]));
});

test('test CommonItem method totalPriceOnRack', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 8, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 5, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);


    // test
    $this->expect(8.0)->toBe($commonItem->totalPriceOnRack([2]));
    $this->expect(13.0)->toBe($commonItem->totalPriceOnRack([1],[3,4]));
});

test('test CommonItem method unitPriceOnRack', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);


    // test
    $this->expect(7.0)->toBe($commonItem->unitPriceOnRack([2]));
    $this->expect(5.0)->toBe($commonItem->unitPriceOnRack([1],[3,4]));
});

