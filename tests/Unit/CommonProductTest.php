<?php

use App\Models\User;
use App\Models\Rack;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

dataset('user', function(){
    yield fn() => User::create([
        'username' => 'test',
        'email' => 'test@test.test',
        'password' => Hash::make('test')
    ]);

});

beforeEach(function () {
    $this->artisan('migrate:fresh');
});

test('test CommonProduct method getQuantityAttribute', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product1 = Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 5, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals(3, $commonProduct->getQuantityAttribute());
})->with('user');

test('test CommonProduct method getTotalPriceAttribute', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product1 = Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals(18, $commonProduct->getTotalPriceAttribute());
})->with('user');

test('test CommonProduct method getStatusQuantityAttribute', function ($user) {
    // datas
    $this->be($user);
    Rack::create(['nb_level' => 5]);
    Brand::create(['name' => 'marque']);
    Category::create(['name' => 'categorie']);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba', 'quantity_low' => 4, 'quantity_critical' => 1]);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be', 'quantity_low' => 9, 'quantity_critical' => 4]);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi', 'quantity_low' => 2, 'quantity_critical' => 1]);

    Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 5, 'serial_number' => 'ite4', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite5', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite6', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 5, 'serial_number' => 'ite7', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite8', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite9', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 4]);

    $commonProduct1 = CommonProduct::find(1);
    $commonProduct2 = CommonProduct::find(2);
    $commonProduct3 = CommonProduct::find(3);

    // test
    
    $this->assertEquals('Quantit?? faible', $commonProduct1->getStatusQuantityAttribute());
    $this->assertEquals('Quantit?? critique', $commonProduct2->getStatusQuantityAttribute());
    $this->assertEquals('Quantit?? suffisante', $commonProduct3->getStatusQuantityAttribute());
})->with('user');

test('test CommonProduct method unitPrice', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals(5, $commonProduct->unitPrice());
})->with('user');

test('test CommonProduct method brand', function ($user) {
    // datas
    $this->be($user);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    // test
    $this->assertEquals([1], $commonProduct->brand()->pluck('id')->toArray());
})->with('user');

test('test CommonProduct method category', function ($user) {
    // datas
    $this->be($user);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    // test
    $this->assertEquals([1], $commonProduct->category()->pluck('id')->toArray());
})->with('user');

test('test CommonProduct method products', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product1 = Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 5, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals([1,2,3], $commonProduct->products()->pluck('id')->toArray());
})->with('user');

test('test CommonProduct method hasProduct', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct1 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $product1 = Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    $product2 = Product::create(['price' => 5, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 5, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    // test
    $this->assertEquals(true, $commonProduct1->hasProduct());
    $this->assertEquals(false, $commonProduct2->hasProduct());
})->with('user');

test('test CommonProduct method productsOnRack', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 3, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 3, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);


    // test
    $this->expect([5,6])->toBe($commonProduct->productsOnRack([2])->pluck('id')->toArray());
    $this->expect([1,3,4])->toBe($commonProduct->productsOnRack([1], [3,4])->pluck('id')->toArray());
})->with('user');

test('test CommonProduct method quantityOnRack', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 3, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 3, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);


    // test
    $this->expect(2)->toBe($commonProduct->quantityOnRack([2]));
    $this->expect(3)->toBe($commonProduct->quantityOnRack([1],[3,4]));
})->with('user');

test('test CommonProduct method totalPriceOnRack', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 8, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 5, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);


    // test
    $this->expect(8.0)->toBe($commonProduct->totalPriceOnRack([2]));
    $this->expect(13.0)->toBe($commonProduct->totalPriceOnRack([1],[3,4]));
})->with('user');

test('test CommonProduct method unitPriceOnRack', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);


    // test
    $this->expect(7.0)->toBe($commonProduct->unitPriceOnRack([2]));
    $this->expect(5.0)->toBe($commonProduct->unitPriceOnRack([1],[3,4]));
})->with('user');

test('test CommonProduct method updateStatusQuantity', function ($user) {
    // datas
    $this->be($user);
    Rack::create(['nb_level' => 5]);
    Brand::create(['name' => 'marque']);
    Category::create(['name' => 'categorie']);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba', 'quantity_low' => 4, 'quantity_critical' => 1]);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be', 'quantity_low' => 9, 'quantity_critical' => 4]);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi', 'quantity_low' => 2, 'quantity_critical' => 1]);

    Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 5, 'serial_number' => 'ite4', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite5', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite6', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 5, 'serial_number' => 'ite7', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite8', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite9', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 4]);

    //methode change code_status_quantity and it is call in ProductObserver on create/delete

    $commonProduct1 = CommonProduct::find(1);
    $commonProduct2 = CommonProduct::find(2);
    $commonProduct3 = CommonProduct::find(3);

    // test
    
    $this->assertEquals('F', $commonProduct1->code_status_quantity);
    $this->assertEquals('C', $commonProduct2->code_status_quantity);
    $this->assertEquals('S', $commonProduct3->code_status_quantity);
})->with('user');

test('test CommonProduct method filterOnQuantities', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);
    
    $commonProducts = collect([$commonProduct, $commonProduct2]);
    
    // test
    $this->expect(CommonProduct::filterOnQuantities($commonProducts, 10, 20))->toEqual(collect([]));
    $this->expect(CommonProduct::filterOnQuantities($commonProducts, 10, null))->toEqual(collect([]));
    $this->expect(CommonProduct::filterOnQuantities($commonProducts, 5, 10))->toEqual(collect([$commonProduct]));
    $this->expect(CommonProduct::filterOnQuantities($commonProducts, 0, 4))->toEqual(collect([$commonProduct2]));
    $this->expect(CommonProduct::filterOnQuantities($commonProducts, 4, 6))->toEqual(collect([$commonProduct, $commonProduct2]));
    $this->expect(CommonProduct::filterOnQuantities($commonProducts, 2, null))->toEqual(collect([$commonProduct, $commonProduct2]));
})->with('user');

test('test CommonProduct method filterOnRacksQuantities', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);
    
    $commonProducts = collect([$commonProduct, $commonProduct2]);
    
    // test
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 4, 6, null, null))->toEqual(collect([$commonProduct, $commonProduct2]));
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 4, 6, [], null))->toEqual(collect([$commonProduct, $commonProduct2]));
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 4, 6, null, []))->toEqual(collect([$commonProduct, $commonProduct2]));
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 4, 6, [], []))->toEqual(collect([$commonProduct, $commonProduct2]));
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 4, 6, [1,2], []))->toEqual(collect([$commonProduct, $commonProduct2]));
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 4, 6, [], [1,2,3,4,5]))->toEqual(collect([$commonProduct, $commonProduct2]));

    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 4, 6, [1], []))->toEqual(collect([$commonProduct]));
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 4, 6, [2], []))->toEqual(collect([]));

    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 2, null, [1], [3]))->toEqual(collect([$commonProduct]));
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 0, null, [1], [5]))->toEqual(collect([]));
    $this->expect(CommonProduct::filterOnRacksQuantities($commonProducts, 1, null, [2], [3]))->toEqual(collect([$commonProduct2]));

})->with('user');

test('test CommonProduct method filterOnBrands', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $brand3 = Brand::create(['name' => 'marque3']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 3, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'bo']);
    
    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]);
    
    // test
    $this->expect(CommonProduct::filterOnBrands($commonProducts, []))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]));
    $this->expect(CommonProduct::filterOnBrands($commonProducts, [1]))->toEqual(collect([$commonProduct]));
    $this->expect(CommonProduct::filterOnBrands($commonProducts, [2]))->toEqual(collect([$commonProduct2, $commonProduct4]));
    $this->expect(CommonProduct::filterOnBrands($commonProducts, [3]))->toEqual(collect([$commonProduct3]));
    $this->expect(CommonProduct::filterOnBrands($commonProducts, [1,3]))->toEqual(collect([$commonProduct, $commonProduct3]));
    $this->expect(CommonProduct::filterOnBrands($commonProducts, [1,2]))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct4]));
    $this->expect(CommonProduct::filterOnBrands($commonProducts, [3,2]))->toEqual(collect([$commonProduct2, $commonProduct3, $commonProduct4]));
    $this->expect(CommonProduct::filterOnBrands($commonProducts, [1,2,3]))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]));
})->with('user');

test('test CommonProduct method filterOnCategories', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $category = Category::create(['name' => 'categorie2']);
    $category = Category::create(['name' => 'categorie3']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 3, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'bo']);
    
    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]);
    
    // test
    $this->expect(CommonProduct::filterOnCategories($commonProducts, []))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]));
    $this->expect(CommonProduct::filterOnCategories($commonProducts, [1]))->toEqual(collect([$commonProduct]));
    $this->expect(CommonProduct::filterOnCategories($commonProducts, [2]))->toEqual(collect([$commonProduct2, $commonProduct4]));
    $this->expect(CommonProduct::filterOnCategories($commonProducts, [3]))->toEqual(collect([$commonProduct3]));
    $this->expect(CommonProduct::filterOnCategories($commonProducts, [1,3]))->toEqual(collect([$commonProduct, $commonProduct3]));
    $this->expect(CommonProduct::filterOnCategories($commonProducts, [1,2]))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct4]));
    $this->expect(CommonProduct::filterOnCategories($commonProducts, [3,2]))->toEqual(collect([$commonProduct2, $commonProduct3, $commonProduct4]));
    $this->expect(CommonProduct::filterOnCategories($commonProducts, [1,2,3]))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]));
})->with('user');

test('test CommonProduct method filterOnquantityStatus', function ($user) {
    // datas
    $this->be($user);
    Rack::create(['nb_level' => 5]);
    Brand::create(['name' => 'marque']);
    Category::create(['name' => 'categorie']);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba', 'quantity_low' => 4, 'quantity_critical' => 1]);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be', 'quantity_low' => 9, 'quantity_critical' => 4]);
    CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi', 'quantity_low' => 2, 'quantity_critical' => 1]);

    Product::create(['price' => 5, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 5, 'serial_number' => 'ite4', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite5', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite6', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 5, 'serial_number' => 'ite7', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 2]);
    Product::create(['price' => 10, 'serial_number' => 'ite8', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite9', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 4]);

    //methode change code_status_quantity and it is call in ProductObserver on create/delete

    $commonProducts = CommonProduct::all();
    $commonProduct1 = CommonProduct::find(1);
    $commonProduct2 = CommonProduct::find(2);
    $commonProduct3 = CommonProduct::find(3);

    $f = CommonProduct::$statutesQuantity['F'];
    $c = CommonProduct::$statutesQuantity['C'];
    $s = CommonProduct::$statutesQuantity['S'];


    // test
    $this->expect(CommonProduct::filterOnquantityStatus($commonProducts, [])->pluck('id')->toArray())->toEqual(collect([$commonProduct1, $commonProduct2, $commonProduct3])->pluck('id')->toArray());
    $this->expect(CommonProduct::filterOnquantityStatus($commonProducts, [$f])->pluck('id')->toArray())->toEqual(collect([$commonProduct1])->pluck('id')->toArray());
    $this->expect(CommonProduct::filterOnquantityStatus($commonProducts, [$c])->pluck('id')->toArray())->toEqual(collect([$commonProduct2])->pluck('id')->toArray());
    $this->expect(CommonProduct::filterOnquantityStatus($commonProducts, [$s])->pluck('id')->toArray())->toEqual(collect([$commonProduct3])->pluck('id')->toArray());
    $this->expect(CommonProduct::filterOnquantityStatus($commonProducts, [$f,$s])->pluck('id')->toArray())->toEqual(collect([$commonProduct1, $commonProduct3])->pluck('id')->toArray());
    $this->expect(CommonProduct::filterOnquantityStatus($commonProducts, [$f,$c])->pluck('id')->toArray())->toEqual(collect([$commonProduct1, $commonProduct2])->pluck('id')->toArray());
    $this->expect(CommonProduct::filterOnquantityStatus($commonProducts, [$c, $s])->pluck('id')->toArray())->toEqual(collect([$commonProduct2, $commonProduct3])->pluck('id')->toArray());
    $this->expect(CommonProduct::filterOnquantityStatus($commonProducts, [$f, $c, $s])->pluck('id')->toArray())->toEqual(collect([$commonProduct1, $commonProduct2, $commonProduct3])->pluck('id')->toArray());
})->with('user');

test('test CommonProduct method sortOnCategories', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorieA']);
    $category = Category::create(['name' => 'categorieB']);
    $category = Category::create(['name' => 'categorieC']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 3, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 2, 'brand_id' => 1, 'model' => 'bo']);
    
    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]);
    
    // test
    $this->expect(CommonProduct::sortOnCategories($commonProducts, 'asc'))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct4, $commonProduct3]));
    $this->expect(CommonProduct::sortOnCategories($commonProducts, 'desc'))->toEqual(collect([$commonProduct3, $commonProduct2, $commonProduct4, $commonProduct]));
})->with('user');

test('test CommonProduct method sortOnBrands', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marqueA']);
    $brand = Brand::create(['name' => 'marqueB']);
    $brand = Brand::create(['name' => 'marqueC']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 3, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 2, 'model' => 'bo']);
    
    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]);
    
    // test
    $this->expect(CommonProduct::sortOnBrands($commonProducts, 'asc'))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct4, $commonProduct3]));
    $this->expect(CommonProduct::sortOnBrands($commonProducts, 'desc'))->toEqual(collect([$commonProduct3, $commonProduct2, $commonProduct4, $commonProduct]));
})->with('user');

test('test CommonProduct method sortOnModels', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);
    
    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4])->shuffle();
    
    // test
    $this->expect(CommonProduct::sortOnModels($commonProducts, 'asc'))->toEqual(collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]));
    $this->expect(CommonProduct::sortOnModels($commonProducts, 'desc'))->toEqual(collect([$commonProduct4, $commonProduct3, $commonProduct2, $commonProduct]));
})->with('user');

test('test CommonProduct method sortOnQuantities', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 4, 'rack_id' => 1, 'rack_level' => 3]);

    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]);
    
    // test
    $this->expect(CommonProduct::sortOnQuantities($commonProducts, 'asc'))->toEqual(collect([$commonProduct4, $commonProduct2, $commonProduct, $commonProduct3]));
    $this->expect(CommonProduct::sortOnQuantities($commonProducts, 'desc'))->toEqual(collect([$commonProduct3, $commonProduct, $commonProduct2, $commonProduct4]));
})->with('user');

test('test CommonProduct method sortOnTotalPrices', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 20, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Product::create(['price' => 5, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 7, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Product::create(['price' => 8, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 8, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 10, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 23, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 29, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 18, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);

    Product::create(['price' => 13, 'serial_number' => 'ite11', 'common_id' => 4, 'rack_id' => 1, 'rack_level' => 3]);

    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]);
    
    // test
    $this->expect(CommonProduct::sortOnTotalPrices($commonProducts, 'asc'))->toEqual(collect([$commonProduct4, $commonProduct2, $commonProduct, $commonProduct3]));
    $this->expect(CommonProduct::sortOnTotalPrices($commonProducts, 'desc'))->toEqual(collect([$commonProduct3, $commonProduct, $commonProduct2, $commonProduct4]));
})->with('user');

test('test CommonProduct method sortOnQuantitiesOnRack', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 4, 'rack_id' => 1, 'rack_level' => 3]);

    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]);
    
    // test
    $this->expect(CommonProduct::sortOnQuantitiesOnRack($commonProducts, 'asc', [], []))->toEqual(collect([$commonProduct4, $commonProduct2, $commonProduct, $commonProduct3]));
    $this->expect(CommonProduct::sortOnQuantitiesOnRack($commonProducts, 'desc', [], []))->toEqual(collect([$commonProduct3, $commonProduct, $commonProduct2, $commonProduct4]));

    $this->expect(CommonProduct::sortOnQuantitiesOnRack($commonProducts, 'asc', [2], []))->toEqual(collect([$commonProduct4, $commonProduct2, $commonProduct, $commonProduct3]));
    $this->expect(CommonProduct::sortOnQuantitiesOnRack($commonProducts, 'desc', [], [2, 3]))->toEqual(collect([$commonProduct3, $commonProduct, $commonProduct2, $commonProduct4]));

    $this->expect(CommonProduct::sortOnQuantitiesOnRack($commonProducts, 'asc', [1], [4]))->toEqual(collect([$commonProduct3, $commonProduct4, $commonProduct, $commonProduct2]));
    $this->expect(CommonProduct::sortOnQuantitiesOnRack($commonProducts, 'desc', [2], [3]))->toEqual(collect([$commonProduct2, $commonProduct3, $commonProduct, $commonProduct4]));
})->with('user');

test('test CommonProduct method sortOnTotalPricesOnRack', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 20, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Product::create(['price' => 5, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 7, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 2]);
    Product::create(['price' => 8, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 8, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 10, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 4]);
    Product::create(['price' => 23, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 29, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 18, 'serial_number' => 'ite11', 'common_id' => 3, 'rack_id' => 1, 'rack_level' => 1]);

    Product::create(['price' => 13, 'serial_number' => 'ite11', 'common_id' => 4, 'rack_id' => 1, 'rack_level' => 3]);

    $commonProducts = collect([$commonProduct, $commonProduct2, $commonProduct3, $commonProduct4]);
    
    // test
    $this->expect(CommonProduct::sortOnTotalPricesOnRack($commonProducts, 'asc', [], []))->toEqual(collect([$commonProduct4, $commonProduct2, $commonProduct, $commonProduct3]));
    $this->expect(CommonProduct::sortOnTotalPricesOnRack($commonProducts, 'desc', [], []))->toEqual(collect([$commonProduct3, $commonProduct, $commonProduct2, $commonProduct4]));

    $this->expect(CommonProduct::sortOnTotalPricesOnRack($commonProducts, 'asc', [2], []))->toEqual(collect([$commonProduct4, $commonProduct2, $commonProduct, $commonProduct3]));
    $this->expect(CommonProduct::sortOnTotalPricesOnRack($commonProducts, 'desc', [], [2, 3]))->toEqual(collect([$commonProduct3, $commonProduct, $commonProduct4, $commonProduct2]));

    $this->expect(CommonProduct::sortOnTotalPricesOnRack($commonProducts, 'asc', [1], [4]))->toEqual(collect([$commonProduct3, $commonProduct4, $commonProduct, $commonProduct2]));
    $this->expect(CommonProduct::sortOnTotalPricesOnRack($commonProducts, 'desc', [2], [3]))->toEqual(collect([$commonProduct3, $commonProduct2, $commonProduct, $commonProduct4]));
})->with('user');

test('test CommonProduct method totalQuantity', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    $product1 = Product::create(['price' => 2, 'serial_number' => 'ite1', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product2 = Product::create(['price' => 10, 'serial_number' => 'ite2', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 1]);
    $product3 = Product::create(['price' => 3, 'serial_number' => 'ite3', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 3]);
    $product4 = Product::create(['price' => 10, 'serial_number' => 'ite4', 'common_id' => 1, 'rack_id' => 1, 'rack_level' => 4]);
    $product5 = Product::create(['price' => 3, 'serial_number' => 'ite5', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 1]);
    $product6 = Product::create(['price' => 11, 'serial_number' => 'ite6', 'common_id' => 1, 'rack_id' => 2, 'rack_level' => 2]);

    Product::create(['price' => 2, 'serial_number' => 'ite11', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite12', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 1]);
    Product::create(['price' => 3, 'serial_number' => 'ite13', 'common_id' => 2, 'rack_id' => 2, 'rack_level' => 3]);
    Product::create(['price' => 10, 'serial_number' => 'ite14', 'common_id' => 2, 'rack_id' => 1, 'rack_level' => 4]);

    Product::factory(['common_id' => 3])->count(10)->create();

    Product::factory(['common_id' => 4])->count(1)->create();
    
    // test
    $this->assertEquals(21, CommonProduct::totalQuantity());
})->with('user');

test('test CommonProduct method totalCommonProduct', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be']);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    
    // test
    $this->assertEquals(4, CommonProduct::totalCommonProduct());
})->with('user');

test('test CommonProduct method totalFavoriteProduct', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba', 'favorite' => true]);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be', 'favorite' => true]);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    
    // test
    $this->assertEquals(2, CommonProduct::totalFavoriteProduct());
})->with('user');

test('test CommonProduct method totalOutStockProduct', function ($user) {
    // datas
    $this->be($user);
    $rack = Rack::create(['nb_level' => 5]);
    $rack = Rack::create(['nb_level' => 2]);

    $brand = Brand::create(['name' => 'marque']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba', 'favorite' => true]);
    $commonProduct2 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'be', 'favorite' => true]);
    $commonProduct3 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bi']);
    $commonProduct4 = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'bo']);

    Product::factory(['common_id' => 3])->count(10)->create();
    
    // test
    $this->assertEquals(3, CommonProduct::totalOutStockProduct());
})->with('user');
