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

test('test category method brands', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    // test
    $this->assertEquals($brand->id, $category->brands->first()->id);
});

test('test category method hasBrand', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    // test
    $this->expect($category->hasBrand($brand))->toBe(true);
    $this->expect($category->hasBrand($brand2))->toBe(false);
});

test('test category method getLinkedBrands', function () {
    // datas
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $brand3 = Brand::create(['name' => 'marque3']);
    $brand4 = Brand::create(['name' => 'marque4']);

    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categori2']);

    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'bo']);
    $commonProduct2 = CommonProduct::create(['category_id' => 2, 'brand_id' => 3, 'model' => 'bi']);

    // test
    $this->assertEquals([1,2,3], Category::getLinkedBrands([1,2])->pluck('id')->toArray());
});
