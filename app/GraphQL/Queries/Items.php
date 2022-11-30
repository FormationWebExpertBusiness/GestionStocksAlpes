<?php

namespace App\GraphQL\Queries;

use App\Models\CommonItem;
use App\Models\Item;
use App\Models\Rack;
use PhpParser\Node\Expr\Cast\Object_;

class Items
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $items = Rack::find($args['rack_id'])->itemsOnLevel($args['rack_level']);
        return $items;
    }
}
