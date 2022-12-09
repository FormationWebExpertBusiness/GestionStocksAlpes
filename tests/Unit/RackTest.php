<?php

use App\Models\Rack;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonProduct;
use App\Models\Product;

afterEach(function () {
    $this->artisan('migrate:fresh');
});

test('test Rack method getQrcode', function() {
    //data
    $rack = Rack::create(['nb_level' => 5]);

    //test
    $this->assertMatchesRegularExpression('</svg>', $rack->getQrcode(1)->__toString());
});

test('test Rack method dataInQrcode', function() {
    //data
    $rack = Rack::create(['nb_level' => 5]);
    $rack2 = Rack::create(['nb_level' => 7]);

    //test
    $this->assertEquals('{"rack_id":1, "rack_level":3}', $rack->dataInQrcode(3));
    $this->assertEquals('{"rack_id":2, "rack_level":7}', $rack2->dataInQrcode(7));
});

test('test Rack method productsOn', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product  = Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    
    // test
    $this->assertEquals([1,2], $rack->productsOn()->pluck('id')->toArray());
});

test('test Rack method productsOnLevel', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product  = Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);

    // test
    $this->assertEquals([2], $rack->productsOnLevel(1)->pluck('id')->toArray());
});

test('test Rack method getRackLevelMax', function () {
    // datas
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);
    $rack = Rack::create(['nb_level' => 7]);

    // test
    $this->assertEquals(7, Rack::getRackLevelMax([1,2,3]));
});



