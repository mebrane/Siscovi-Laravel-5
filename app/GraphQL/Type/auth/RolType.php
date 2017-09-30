<?php

namespace App\GraphQL\Type\auth;

use Rebing\GraphQL\Support\Type as GraphQLType;

class RolType extends GraphQLType
{
    protected $attributes = [
        'name' => 'RolType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [

        ];
    }
}