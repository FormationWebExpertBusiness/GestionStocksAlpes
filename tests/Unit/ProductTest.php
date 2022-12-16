<?php

use App\GraphQL\Queries\Products;
use App\Models\Rack;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonProduct;
use App\Models\Product;

beforeEach(function () {
    $this->artisan('migrate:fresh');
});

test('test Product method getCategory', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'categorie2']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);

    // test
    $this->assertEquals(1, $product->getCategory()->id);
    $this->assertEquals(2, $product2->getCategory()->id);
})->with('user');

test('test Product method getBrand', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);

    // test
    $this->assertEquals(1, $product->getBrand()->id);
    $this->assertEquals(2, $product2->getBrand()->id);
})->with('user');

test('test Product method getModel', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);

    // test
    $this->assertEquals('ba', $product->getModel());
    $this->assertEquals('be', $product2->getModel());
})->with('user');

test('test Product method rack', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    // test
    $this->assertEquals([1], $product2->rack()->pluck('id')->toArray());
})->with('user');

test('test Product method mostExpensiveProduct', function ( $user) {
    // datas
    $this->be($user);
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
})->with('user');

test('test Product method sortOnCreatedAt', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    $products = Product::all();

    // test
    $this->assertEquals([5,4,3,2,1], Product::sortOnCreatedAt($products, 'desc')->pluck('id')->toArray());
    $this->assertEquals([1,2,3,4,5], Product::sortOnCreatedAt($products, 'asc')->pluck('id')->toArray());
})->with('user');
