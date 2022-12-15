<?php

namespace App\Observers;

use App\Models\CommonProduct;
use App\Models\HistoryProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $commonProduct = CommonProduct::find($product->common_id);

        $commonProduct->updateStatusQuantity();

        HistoryProduct::create([
            'code_action' => 'C',
            'category' => $commonProduct->category->name,
            'brand' => $commonProduct->brand->name,
            'model' => $commonProduct->model,
            'serial_number' => $product->serial_number,
            'price' => $product->price,
            'user_id' => $product->mobileUser->id ?? Auth::user()->id,
            'comment' => $product->comment,
        ]);

        $product->mobileUser = null;
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $commonProduct = CommonProduct::find($product->common_id);

        $commonProduct->updateStatusQuantity();

        HistoryProduct::create([
            'code_action' => 'U',
            'category' => $commonProduct->category->name,
            'brand' => $commonProduct->brand->name,
            'model' => $commonProduct->model,
            'serial_number' => $product->serial_number,
            'price' => $product->price,
            'user_id' => $product->mobileUser->id ?? Auth::user()->id,
            'comment' => $product->comment,
        ]);
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $commonProduct = CommonProduct::find($product->common_id);

        $commonProduct->updateStatusQuantity();

        HistoryProduct::create([
            'category' => $commonProduct->category->name,
            'code_action' => 'D',
            'brand' => $commonProduct->brand->name,
            'model' => $commonProduct->model,
            'serial_number' => $product->serial_number,
            'price' => $product->price,
            'user_id' => $product->mobileUser->id ?? Auth::user()->id,
            'comment' => $product->comment,
        ]);
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
