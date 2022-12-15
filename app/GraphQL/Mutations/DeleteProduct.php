<?php

namespace App\GraphQL\Mutations;

use App\Models\CommonProduct;
use App\Models\HistoryProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DeleteProduct
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $product = Product::find($args['id']);
        $commonProduct = CommonProduct::find($product->common_id);
        $product->mobileUser = User::find($args['user_id']);

        Log::debug('av delete');

        $product->delete();

        HistoryProduct::create([
            'code_action' => 'C',
            'category' => $commonProduct->category->name,
            'brand' => $commonProduct->brand->name,
            'model' => $commonProduct->model,
            'serial_number' => $product->serial_number,
            'price' => $product->price,
            'user_id' => Auth::user()->id ?? 1,
            'comment' => $product->comment,
        ]);

        Log::debug('ok');

        return $product;
    }
}
