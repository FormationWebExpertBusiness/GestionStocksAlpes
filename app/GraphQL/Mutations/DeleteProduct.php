<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use App\Models\User;

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
        $product->comment = $args['comment'] ?? $product->comment;

        $product->delete();

        return $product;
    }
}
