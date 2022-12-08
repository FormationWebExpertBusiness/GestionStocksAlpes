<?php

namespace App\GraphQL\Queries;

use App\Models\Rack as ModelsRack;

class Rack
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $rack = ModelsRack::find($args['id']);
        $rack->nb_product = $rack->productsOnLevel($args['level'])->count();
        return $rack;
    }
}
