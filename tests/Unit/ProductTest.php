<?php

use App\Models\Rack;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonProduct;
use App\Models\Product;

afterEach(function () {
    $this->artisan('migrate:fresh');
});

test('test Product method rack', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    // test
    $this->assertEquals([1], $product2->rack()->pluck('id')->toArray());
});

test('test Product method getModel', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    // test
    $this->assertEquals('ba', $product->getModel());
});

test('test Product method mostExpensiveProduct', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    // test
    $this->assertEquals($product5->id, $product->mostExpensiveProduct()->id);
});
