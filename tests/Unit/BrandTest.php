<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonProduct;

beforeEach(function () {
    $this->artisan('migrate:fresh');
});

test('test brand method hasCommonProduct', function () {
    //data
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $commonProduct = CommonProduct::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    expect($brand->hasCommonProduct())->toBe(true);
    expect($brand2->hasCommonProduct())->toBe(false);
});
