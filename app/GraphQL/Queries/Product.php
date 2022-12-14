<?php

namespace App\GraphQL\Queries;

use App\Models;

class Product
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $product = Models\Product::find($args['id']);
        
        $product->category = $product->getCategory();
        $product->brand = $product->getBrand();
        $product->model = $product->getModel();
    
        return $product;
    }
    
}
