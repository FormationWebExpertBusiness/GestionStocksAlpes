<?php

use App\Models\Rack;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonProduct;
use App\Models\HistoryProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->artisan('migrate:fresh');
});

test('test HistoryProduct method oldestDate', function () {  
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite', 
        'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s')
    ]);

    // test
    $this->assertEquals(Carbon::yesterday()->format('Y-m-d'), HistoryProduct::oldestDate());
});

test('test HistoryProduct method newestDate', function () {  
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite', 
        'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s')
    ]);

    // test
    $this->assertEquals(Carbon::tomorrow()->format('Y-m-d'), HistoryProduct::newestDate());
});

test('test HistoryProduct method getAllBrands', function () {  
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite', 
        'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra2', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s')
    ]);

    // test
    $this->assertEquals( ['bra', 'bra2'], HistoryProduct::getAllBrands() );
});

test('test HistoryProduct method getAllCategories', function () {  
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite', 
        'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat2', 'brand' => 'bra2', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s')
    ]);

    // test
    $this->assertEquals( ['cat', 'cat2'], HistoryProduct::getAllCategories() );
});

test('test HistoryProduct method filterOnBrands', function () {  
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite', 
        'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat2', 'brand' => 'bra2', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s')
    ]);

    $historyProducts = HistoryProduct::all();

    // test
    $this->assertEquals( [1,3], HistoryProduct::filterOnBrands($historyProducts, ['bra'])->pluck('id')->toArray() );
    $this->assertEquals( [2], HistoryProduct::filterOnBrands($historyProducts, ['bra2'])->pluck('id')->toArray() );
    $this->assertEquals( [], HistoryProduct::filterOnBrands($historyProducts, ['bra3'])->pluck('id')->toArray() );
});

test('test HistoryProduct method filterOnCategories', function () {  
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite', 
        'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat2', 'brand' => 'bra2', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s')
    ]);

    $historyProducts = HistoryProduct::all();

    // test
    $this->assertEquals( [1,3], HistoryProduct::filterOnCategories($historyProducts, ['cat'])->pluck('id')->toArray() );
    $this->assertEquals( [2], HistoryProduct::filterOnCategories($historyProducts, ['cat2'])->pluck('id')->toArray() );
    $this->assertEquals( [], HistoryProduct::filterOnCategories($historyProducts, ['cat3'])->pluck('id')->toArray() );
});

test('test HistoryProduct method filterOnMovedAfter', function () {  
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite', 
        'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat2', 'brand' => 'bra2', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::today()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s')
    ]);

    $historyProducts = HistoryProduct::all();

    // test
    $this->assertEquals( [1,2,3], HistoryProduct::filterOnMovedAfter($historyProducts, Carbon::yesterday()->format('Y-m-d'))->pluck('id')->toArray() );
    $this->assertEquals( [1,2], HistoryProduct::filterOnMovedAfter($historyProducts, Carbon::today()->format('Y-m-d'))->pluck('id')->toArray() );
    $this->assertEquals( [1], HistoryProduct::filterOnMovedAfter($historyProducts, Carbon::tomorrow()->format('Y-m-d'))->pluck('id')->toArray() );
});

test('test HistoryProduct method filterOnMovedBefore', function () {  
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite', 
        'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat2', 'brand' => 'bra2', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::today()->format('Y-m-d H:i:s')
    ]);
    DB::table('history_products')->insert(['code_action' => 'C', 'category' => 'cat', 'brand' => 'bra', 'model' => 'mod' ,'price' => 5, 'serial_number' => 'ite',
        'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s')
    ]);

    $historyProducts = HistoryProduct::all();

    // test
    $this->assertEquals( [3], HistoryProduct::filterOnMovedBefore($historyProducts, Carbon::yesterday()->format('Y-m-d'))->pluck('id')->toArray() );
    $this->assertEquals( [2,3], HistoryProduct::filterOnMovedBefore($historyProducts, Carbon::today()->format('Y-m-d'))->pluck('id')->toArray() );
    $this->assertEquals( [1,2,3], HistoryProduct::filterOnMovedBefore($historyProducts, Carbon::tomorrow()->format('Y-m-d'))->pluck('id')->toArray() );
});