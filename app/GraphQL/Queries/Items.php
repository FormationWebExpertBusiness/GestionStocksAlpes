<?php

namespace App\GraphQL\Queries;

use App\Models\Item;

final class Items
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Item::where('rack_id', $args['rack_id'])->where('rack_level', $args['rack_level'])->get();
    }
}
