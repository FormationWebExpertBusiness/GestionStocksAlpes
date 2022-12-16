<?php

namespace App\GraphQL\Mutations;

use App\Models\CommonProduct;
use App\Models\HistoryProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteProduct
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $product = Product::find($args['id']);
        $product->mobileUser = User::find($args['user_id']);

        $product->delete();

        return $product;
    }
}
