<?php

namespace App\GraphQL\Queries;

use App\Models\CommonProduct;
use App\Models\Product;
use App\Models\Rack;
use PhpParser\Node\Expr\Cast\Object_;

class Products
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $products = Rack::find($args['rack_id'])->productsOnLevel($args['rack_level']);
        foreach ($products as $product) {
            $product->category = $product->getCategory();
            $product->brand = $product->getBrand();
            $product->model = $product->getModel();
        } 
        return $products;
    }
}
