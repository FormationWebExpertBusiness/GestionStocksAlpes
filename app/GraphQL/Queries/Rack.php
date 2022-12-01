<?php

namespace App\GraphQL\Queries;

use App\Models\Rack as ModelsRack;

use Illuminate\Support\Facades\Log;

final class Rack
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $rack = ModelsRack::find($args['id']);
        $rack->nb_item = $rack->itemsOnLevel($args['level'])->count();
        return $rack;
    }
}
