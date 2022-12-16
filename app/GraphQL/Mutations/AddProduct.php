<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use App\Models\User;

class AddProduct
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user_id = $args['user_id'];
        unset($args['user_id']);

        $product = new Product($args);
        $product->mobileUser = User::find($user_id);
        $product->save();

        return $product;
    }
}
