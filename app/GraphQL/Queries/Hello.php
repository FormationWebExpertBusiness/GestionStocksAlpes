<?php

namespace App\GraphQL\Queries;

class Hello
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return 'hello world!';
    }
}
