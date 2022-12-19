<?php

namespace App\GraphQL\Queries;

use App\Models\CommonProduct;

class CommonProducts
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $commonProducts = CommonProduct::all();
        $commonProducts = CommonProduct::sortOnModels($commonProducts, 'asc');
        return CommonProduct::sortOnCategories($commonProducts, 'asc');
    }
}
