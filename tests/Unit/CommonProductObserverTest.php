<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonProduct;

afterEach(function () {
    $this->artisan('migrate:fresh');
});

beforeEach(function () {
    $this->artisan('migrate:fresh');
});

test('test CommonProductObserver method created', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    // test
    $this->expect([1])->toBe($category->brands->pluck('id')->toArray());
});

test('test CommonProductObserver method deleted', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);

    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);

    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $commonProduct2->delete();

    $commonProduct3 = CommonProduct::create(['category_id' => 2, 'brand_id' => 2, 'model' => 'bi']);

    $commonProduct3->delete();

    // test
    $this->expect([1])->toBe($category->brands->pluck('id')->toArray());

    $this->expect([])->toBe($category2->brands->pluck('id')->toArray());
});

test('test CommonProductObserver method updated from void to void', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $commonProduct->update(['category_id' => 2, 'brand_id' => 2, 'model' => 'bo']);

    // test
    $this->expect([])->toBe($category->brands->pluck('id')->toArray());
    $this->expect([2])->toBe($category2->brands->pluck('id')->toArray());
});

test('test CommonProductObserver method updated from thing to thing', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 2, 'brand_id' => 2, 'model' => 'bo']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);

    $commonProduct3->update(['category_id' => 2, 'brand_id' => 2, 'model' => 'bi']);

    // test
    $this->expect([1])->toBe($category->brands->pluck('id')->toArray());
    $this->expect([2])->toBe($category2->brands->pluck('id')->toArray());
});

test('test CommonProductObserver method updated from thing to void', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $commonProduct2->update(['category_id' => 2, 'brand_id' => 2, 'model' => 'bo']);

    // test
    $this->expect([1])->toBe($category->brands->pluck('id')->toArray());
    $this->expect([2])->toBe($category2->brands->pluck('id')->toArray());
});

test('test CommonProductObserver method updated from void to thing', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonProduct = CommonProduct::create(['category_id' => 2, 'brand_id' => 2, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $commonProduct2->update(['category_id' => 2, 'brand_id' => 2, 'model' => 'bo']);

    // test
    $this->expect([])->toBe($category->brands->pluck('id')->toArray());
    $this->expect([2])->toBe($category2->brands->pluck('id')->toArray());
});