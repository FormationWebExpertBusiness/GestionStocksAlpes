<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;

afterEach(function () {
    $this->artisan('migrate:fresh');
});

beforeEach(function () {
    $this->artisan('migrate:fresh');
});

test('test CommonItemObserver method created', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    // test
    $this->expect([1])->toBe($category->brands->pluck('id')->toArray());
});

test('test CommonItemObserver method deleted', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);

    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);

    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $commonItem2->delete();

    $commonItem3 = CommonItem::create(['category_id' => 2, 'brand_id' => 2, 'model' => 'bi']);

    $commonItem3->delete();

    // test
    $this->expect([1])->toBe($category->brands->pluck('id')->toArray());

    $this->expect([])->toBe($category2->brands->pluck('id')->toArray());
});

test('test CommonItemObserver method updated from void to void', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $commonItem->update(['category_id' => 2, 'brand_id' => 2, 'model' => 'bo']);

    // test
    $this->expect([])->toBe($category->brands->pluck('id')->toArray());
    $this->expect([2])->toBe($category2->brands->pluck('id')->toArray());
});

test('test CommonItemObserver method updated from thing to thing', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 2, 'brand_id' => 2, 'model' => 'bo']);
    $commonItem3 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);

    $commonItem3->update(['category_id' => 2, 'brand_id' => 2, 'model' => 'bi']);

    // test
    $this->expect([1])->toBe($category->brands->pluck('id')->toArray());
    $this->expect([2])->toBe($category2->brands->pluck('id')->toArray());
});

test('test CommonItemObserver method updated from thing to void', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $commonItem2->update(['category_id' => 2, 'brand_id' => 2, 'model' => 'bo']);

    // test
    $this->expect([1])->toBe($category->brands->pluck('id')->toArray());
    $this->expect([2])->toBe($category2->brands->pluck('id')->toArray());
});

test('test CommonItemObserver method updated from void to thing', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonItem = CommonItem::create(['category_id' => 2, 'brand_id' => 2, 'model' => 'ba']);
    $commonItem2 = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $commonItem2->update(['category_id' => 2, 'brand_id' => 2, 'model' => 'bo']);

    // test
    $this->expect([])->toBe($category->brands->pluck('id')->toArray());
    $this->expect([2])->toBe($category2->brands->pluck('id')->toArray());
});