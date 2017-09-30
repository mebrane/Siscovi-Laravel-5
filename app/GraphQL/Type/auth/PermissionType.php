<?php

namespace App\GraphQL\Type\auth;

use Rebing\GraphQL\Support\Type as GraphQLType;

class PermissionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PermissionType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [

        ];
    }
}