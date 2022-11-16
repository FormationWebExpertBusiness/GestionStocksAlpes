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

test('test CommonItem method filterOnQuantities', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);
    
    $commonItems = collect([$commonItem, $commonItem2]);
    
    // test
    $this->expect(CommonItem::filterOnQuantities($commonItems, 10, 20))->toEqual(collect([]));
    $this->expect(CommonItem::filterOnQuantities($commonItems, 10, null))->toEqual(collect([]));
    $this->expect(CommonItem::filterOnQuantities($commonItems, 5, 10))->toEqual(collect([$commonItem]));
    $this->expect(CommonItem::filterOnQuantities($commonItems, 0, 4))->toEqual(collect([$commonItem2]));
    $this->expect(CommonItem::filterOnQuantities($commonItems, 4, 6))->toEqual(collect([$commonItem, $commonItem2]));
    $this->expect(CommonItem::filterOnQuantities($commonItems, 2, null))->toEqual(collect([$commonItem, $commonItem2]));
});

test('test CommonItem method filterOnRacksQuantities', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);
    
    $commonItems = collect([$commonItem, $commonItem2]);
    
    // test
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 4, 6, null, null))->toEqual(collect([$commonItem, $commonItem2]));
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 4, 6, [], null))->toEqual(collect([$commonItem, $commonItem2]));
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 4, 6, null, []))->toEqual(collect([$commonItem, $commonItem2]));
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 4, 6, [], []))->toEqual(collect([$commonItem, $commonItem2]));
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 4, 6, [1,2], []))->toEqual(collect([$commonItem, $commonItem2]));
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 4, 6, [], [1,2,3,4,5]))->toEqual(collect([$commonItem, $commonItem2]));

    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 4, 6, [1], []))->toEqual(collect([$commonItem]));
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 4, 6, [2], []))->toEqual(collect([]));

    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 2, null, [1], [3]))->toEqual(collect([$commonItem]));
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 0, null, [1], [5]))->toEqual(collect([]));
    $this->expect(CommonItem::filterOnRacksQuantities($commonItems, 1, null, [2], [3]))->toEqual(collect([$commonItem2]));

});

test('test CommonItem method filterOnBrands', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $brand3 = Brand::create(['name' => 'marque3']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 3, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'bo']);
    
    $commonItems = collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]);
    
    // test
    $this->expect(CommonItem::filterOnBrands($commonItems, []))->toEqual(collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]));
    $this->expect(CommonItem::filterOnBrands($commonItems, [1]))->toEqual(collect([$commonItem]));
    $this->expect(CommonItem::filterOnBrands($commonItems, [2]))->toEqual(collect([$commonItem2, $commonItem4]));
    $this->expect(CommonItem::filterOnBrands($commonItems, [3]))->toEqual(collect([$commonItem3]));
    $this->expect(CommonItem::filterOnBrands($commonItems, [1,3]))->toEqual(collect([$commonItem, $commonItem3]));
    $this->expect(CommonItem::filterOnBrands($commonItems, [1,2]))->toEqual(collect([$commonItem, $commonItem2, $commonItem4]));
    $this->expect(CommonItem::filterOnBrands($commonItems, [3,2]))->toEqual(collect([$commonItem2, $commonItem3, $commonItem4]));
    $this->expect(CommonItem::filterOnBrands($commonItems, [1,2,3]))->toEqual(collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]));
});

test('test CommonItem method filterOnCategories', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $category = Category::create(['name' => 'categorie2']);
    $category = Category::create(['name' => 'categorie3']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 3, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'bo']);
    
    $commonItems = collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]);
    
    // test
    $this->expect(CommonItem::filterOnCategories($commonItems, []))->toEqual(collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]));
    $this->expect(CommonItem::filterOnCategories($commonItems, [1]))->toEqual(collect([$commonItem]));
    $this->expect(CommonItem::filterOnCategories($commonItems, [2]))->toEqual(collect([$commonItem2, $commonItem4]));
    $this->expect(CommonItem::filterOnCategories($commonItems, [3]))->toEqual(collect([$commonItem3]));
    $this->expect(CommonItem::filterOnCategories($commonItems, [1,3]))->toEqual(collect([$commonItem, $commonItem3]));
    $this->expect(CommonItem::filterOnCategories($commonItems, [1,2]))->toEqual(collect([$commonItem, $commonItem2, $commonItem4]));
    $this->expect(CommonItem::filterOnCategories($commonItems, [3,2]))->toEqual(collect([$commonItem2, $commonItem3, $commonItem4]));
    $this->expect(CommonItem::filterOnCategories($commonItems, [1,2,3]))->toEqual(collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]));
});

test('test CommonItem method sortOnCategories', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorieA']);
    $category = Category::create(['name' => 'categorieB']);
    $category = Category::create(['name' => 'categorieC']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 3, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'bo']);
    
    $commonItems = collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]);
    
    // test
    $this->expect(CommonItem::sortOnCategories($commonItems, 'asc'))->toEqual(collect([$commonItem, $commonItem2, $commonItem4, $commonItem3]));
    $this->expect(CommonItem::sortOnCategories($commonItems, 'desc'))->toEqual(collect([$commonItem3, $commonItem2, $commonItem4, $commonItem]));
});

test('test CommonItem method sortOnBrands', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marqueA']);
    $brand = Brand::create(['name' => 'marqueB']);
    $brand = Brand::create(['name' => 'marqueC']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 3, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'bo']);
    
    $commonItems = collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]);
    
    // test
    $this->expect(CommonItem::sortOnBrands($commonItems, 'asc'))->toEqual(collect([$commonItem, $commonItem2, $commonItem4, $commonItem3]));
    $this->expect(CommonItem::sortOnBrands($commonItems, 'desc'))->toEqual(collect([$commonItem3, $commonItem2, $commonItem4, $commonItem]));
});

test('test CommonItem method sortOnModels', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);
    
    $commonItems = collect([$commonItem, $commonItem2, $commonItem3, $commonItem4])->shuffle();
    
    // test
    $this->expect(CommonItem::sortOnModels($commonItems, 'asc'))->toEqual(collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]));
    $this->expect(CommonItem::sortOnModels($commonItems, 'desc'))->toEqual(collect([$commonItem4, $commonItem3, $commonItem2, $commonItem]));
});

test('test CommonItem method sortOnQuantitiesOnRack', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 3]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 3]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);

    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 4, 'rack_id' => 1, 'rack_level' => 3]);

    $commonItems = collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]);
    
    // test
    $this->expect(CommonItem::sortOnQuantitiesOnRack($commonItems, 'asc', [], []))->toEqual(collect([$commonItem4, $commonItem2, $commonItem, $commonItem3]));
    $this->expect(CommonItem::sortOnQuantitiesOnRack($commonItems, 'desc', [], []))->toEqual(collect([$commonItem3, $commonItem, $commonItem2, $commonItem4]));

    $this->expect(CommonItem::sortOnQuantitiesOnRack($commonItems, 'asc', [2], []))->toEqual(collect([$commonItem4, $commonItem2, $commonItem, $commonItem3]));
    $this->expect(CommonItem::sortOnQuantitiesOnRack($commonItems, 'desc', [], [2, 3]))->toEqual(collect([$commonItem3, $commonItem, $commonItem2, $commonItem4]));

    $this->expect(CommonItem::sortOnQuantitiesOnRack($commonItems, 'asc', [1], [4]))->toEqual(collect([$commonItem3, $commonItem4, $commonItem, $commonItem2]));
    $this->expect(CommonItem::sortOnQuantitiesOnRack($commonItems, 'desc', [2], [3]))->toEqual(collect([$commonItem2, $commonItem3, $commonItem, $commonItem4]));
});

test('test CommonItem method sortOnTotalPricesOnRack', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 20, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Item::create(['price' => 5, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 3]);
    Item::create(['price' => 7, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Item::create(['price' => 8, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Item::create(['price' => 8, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Item::create(['price' => 10, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Item::create(['price' => 23, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 3]);
    Item::create(['price' => 29, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 18, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);

    Item::create(['price' => 13, 'serial_number' => 'ite11', 'common_id' => 4, 'rack_id' => 1, 'rack_level' => 3]);

    $commonItems = collect([$commonItem, $commonItem2, $commonItem3, $commonItem4]);
    
    // test
    $this->expect(CommonItem::sortOnTotalPricesOnRack($commonItems, 'asc', [], []))->toEqual(collect([$commonItem4, $commonItem2, $commonItem, $commonItem3]));
    $this->expect(CommonItem::sortOnTotalPricesOnRack($commonItems, 'desc', [], []))->toEqual(collect([$commonItem3, $commonItem, $commonItem2, $commonItem4]));

    $this->expect(CommonItem::sortOnTotalPricesOnRack($commonItems, 'asc', [2], []))->toEqual(collect([$commonItem4, $commonItem2, $commonItem, $commonItem3]));
    $this->expect(CommonItem::sortOnTotalPricesOnRack($commonItems, 'desc', [], [2, 3]))->toEqual(collect([$commonItem3, $commonItem, $commonItem4, $commonItem2]));

    $this->expect(CommonItem::sortOnTotalPricesOnRack($commonItems, 'asc', [1], [4]))->toEqual(collect([$commonItem3, $commonItem4, $commonItem, $commonItem2]));
    $this->expect(CommonItem::sortOnTotalPricesOnRack($commonItems, 'desc', [2], [3]))->toEqual(collect([$commonItem3, $commonItem2, $commonItem, $commonItem4]));
});

test('test CommonItem method totalQuantity', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $item1 = Item::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item2 = Item::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $item3 = Item::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $item4 = Item::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $item5 = Item::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $item6 = Item::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Item::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Item::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Item::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Item::factory(['common_id' => 3])->count(10)->create();

    Item::factory(['common_id' => 4])->count(1)->create();
    
    // test
    $this->assertEquals(21, CommonItem::totalQuantity());
});

test('test CommonItem method totalCommonItem', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    
    // test
    $this->assertEquals(4, CommonItem::totalCommonItem());
});

test('test CommonItem method totalFavoriteItem', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba', 'favorite' => true]);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be', 'favorite' => true]);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    
    // test
    $this->assertEquals(2, CommonItem::totalFavoriteItem());
});

test('test CommonItem method totalOutStockItem', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba', 'favorite' => true]);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be', 'favorite' => true]);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonItem4 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    Item::factory(['common_id' => 3])->count(10)->create();
    
    // test
    $this->assertEquals(3, CommonItem::totalOutStockItem());
});
