<?php

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

test('test Product method sortOnCategories', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'dategorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    $products = Product::all();

    // test
    $this->assertEquals([4,2,5,3,1], Product::sortOnCategories($products, 'desc')->pluck('id')->toArray());
    $this->assertEquals([1,3,5,2,4], Product::sortOnCategories($products, 'asc')->pluck('id')->toArray());
})->with('user');

test('test Product method sortOnBrands', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'narque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    $products = Product::all();

    // test
    $this->assertEquals([4,2,5,3,1], Product::sortOnBrands($products, 'desc')->pluck('id')->toArray());
    $this->assertEquals([1,3,5,2,4], Product::sortOnBrands($products, 'asc')->pluck('id')->toArray());
})->with('user');

test('test Product method sortOnModels', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    $products = Product::all();

    // test
    $this->assertEquals([4,2,5,3,1], Product::sortOnModels($products, 'desc')->pluck('id')->toArray());
    $this->assertEquals([1,3,5,2,4], Product::sortOnModels($products, 'asc')->pluck('id')->toArray());
})->with('user');

test('test Product method sortOnSerialNumbers', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product = Product::create(['price' => 5, 'serial_number' => 'itea', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'iteb', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'itec', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);

    $products = Product::all();

    // test
    $this->assertEquals([5,3,1,4,2], Product::sortOnSerialNumbers($products, 'desc')->pluck('id')->toArray());
    $this->assertEquals([2,4,1,3,5], Product::sortOnSerialNumbers($products, 'asc')->pluck('id')->toArray());
})->with('user');

test('test Product method sortOnRacks', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product = Product::create(['price' => 5, 'serial_number' => 'itea', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'iteb', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'itec', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 5]);

    $products = Product::all();

    // test
    $this->assertEquals([4,2,5,3,1], Product::sortOnRacks($products, 'desc')->pluck('id')->toArray());
    $this->assertEquals([1,3,5,2,4], Product::sortOnRacks($products, 'asc')->pluck('id')->toArray());
})->with('user');

test('test Product method sortOnPrices', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product = Product::create(['price' => 5, 'serial_number' => 'itea', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'iteb', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'itec', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 5]);

    $products = Product::all();

    // test
    $this->assertEquals([5,3,2,1,4], Product::sortOnPrices($products, 'desc')->pluck('id')->toArray());
    $this->assertEquals([4,1,2,3,5], Product::sortOnPrices($products, 'asc')->pluck('id')->toArray());
})->with('user');

test('test Product method filterOnBrands', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'narque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'itea', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'iteb', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite4', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'itec', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 5]);

    $products = Product::all();

    // test
    $this->assertEquals([1,2,3,4,5], Product::filterOnBrands($products, [])->pluck('id')->toArray());
    $this->assertEquals([1,3,5], Product::filterOnBrands($products, [1])->pluck('id')->toArray());
    $this->assertEquals([2,4], Product::filterOnBrands($products, [2])->pluck('id')->toArray());
    $this->assertEquals([1,2,3,4,5], Product::filterOnBrands($products, [1,2])->pluck('id')->toArray());
})->with('user');

test('test Product method filterOnCategories', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $category2 = Category::create(['name' => 'dategorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct = CommonProduct::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'itea', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'iteb', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite4', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'itec', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 5]);

    $products = Product::all();

    // test
    $this->assertEquals([1,2,3,4,5], Product::filterOnCategories($products, [])->pluck('id')->toArray());
    $this->assertEquals([1,3,5], Product::filterOnCategories($products, [1])->pluck('id')->toArray());
    $this->assertEquals([2,4], Product::filterOnCategories($products, [2])->pluck('id')->toArray());
    $this->assertEquals([1,2,3,4,5], Product::filterOnCategories($products, [1,2])->pluck('id')->toArray());
})->with('user');

test('test Product method filterOnCommonProduct', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'itea', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'iteb', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite4', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'itec', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 5]);

    $products = Product::all();

    // test
    $this->assertEquals([1,2,3,4,5], Product::filterOnCommonProduct($products, [])->pluck('id')->toArray());
    $this->assertEquals([1,3,5], Product::filterOnCommonProduct($products, [1])->pluck('id')->toArray());
    $this->assertEquals([2,4], Product::filterOnCommonProduct($products, [2])->pluck('id')->toArray());
    $this->assertEquals([1,2,3,4,5], Product::filterOnCommonProduct($products, [1,2])->pluck('id')->toArray());
})->with('user');

test('test Product method filterOnRack', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'itea', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'iteb', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite4', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'itec', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 5]);

    $products = Product::all();

    // test
    $this->assertEquals([1,2,3,4,5], Product::filterOnRack($products, [])->pluck('id')->toArray());
    $this->assertEquals([1,3,5], Product::filterOnRack($products, [1])->pluck('id')->toArray());
    $this->assertEquals([2,4], Product::filterOnRack($products, [2])->pluck('id')->toArray());
    $this->assertEquals([1,2,3,4,5], Product::filterOnRack($products, [1,2])->pluck('id')->toArray());
})->with('user');

test('test Product method filterOnRackLevel', function ( $user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 3]);
    $rack = Rack::create(['nb_level' => 4]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $product = Product::create(['price' => 5, 'serial_number' => 'itea', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 7, 'serial_number' => 'ite2', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 9, 'serial_number' => 'iteb', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 1, 'serial_number' => 'ite4', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 2]);
    $product5 = Product::create(['price' => 12, 'serial_number' => 'itec', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);

    $products = Product::all();

    // test
    $this->assertEquals([1,2,3,4,5], Product::filterOnRackLevel($products, [])->pluck('id')->toArray());
    $this->assertEquals([2,5], Product::filterOnRackLevel($products, [1])->pluck('id')->toArray());
    $this->assertEquals([1,4], Product::filterOnRackLevel($products, [2])->pluck('id')->toArray());
    $this->assertEquals([3], Product::filterOnRackLevel($products, [3])->pluck('id')->toArray());
    $this->assertEquals([], Product::filterOnRackLevel($products, [4])->pluck('id')->toArray());
    $this->assertEquals([1,2,4,5], Product::filterOnRackLevel($products, [1,2])->pluck('id')->toArray());
    $this->assertEquals([2,3,5], Product::filterOnRackLevel($products, [1,3])->pluck('id')->toArray());
    $this->assertEquals([1,3,4], Product::filterOnRackLevel($products, [2,3])->pluck('id')->toArray());
    $this->assertEquals([1,2,3,4,5], Product::filterOnRackLevel($products, [1,2,3])->pluck('id')->toArray());
    $this->assertEquals([1,2,3,4,5], Product::filterOnRackLevel($products, [1,2,3,4])->pluck('id')->toArray());
})->with('user')->only();