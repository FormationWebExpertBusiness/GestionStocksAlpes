<?php

namespace App\GraphQL\Queries;

use App\Models\CommonItem;

class CommonItems
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return CommonItem::all();
    }
}
