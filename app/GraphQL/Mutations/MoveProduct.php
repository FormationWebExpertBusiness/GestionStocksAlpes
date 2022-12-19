<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use App\Models\User;

class MoveProduct
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $product = Product::find($args['id']);
        $product->rack_id = $args['rack_id'];
        $product->rack_level = $args['rack_level'];
        $product->mobileUser = User::find($args['user_id']);
        $product->save();

        return $product;
    }
}
