<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;

beforeEach(function () {
    $this->artisan('migrate:fresh');
});

test('test brand method hasCommonItem', function () {
    //data
    $brand = Brand::create(['name' => 'marque']);
    $brand2 = Brand::create(['name' => 'marque2']);
    $category = Category::create(['name' => 'categorie']);
    $commonItem = CommonItem::create(['category_id' => 1, 'brand_id' => 1, 'model' => 'ba']);

    expect($brand->hasCommonItem())->toBe(true);
    expect($brand2->hasCommonItem())->toBe(false);
});
