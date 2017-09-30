<?php

namespace App\GraphQL\Type\auth;

use Rebing\GraphQL\Support\Type as GraphQLType;

class LoginType extends GraphQLType
{
    protected $attributes = [
        'name' => 'LoginType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [

        ];
    }
}