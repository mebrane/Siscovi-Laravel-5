<?php

namespace App\GraphQL\Type\auth;

use App\GraphQL\traits\GraphQLTypeTrait;
use App\models\auth\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    use GraphQLTypeTrait;
    protected $attributes = [
        'name' => 'UserType',
        'description' => 'A type',
        'model' => User::class,
    ];

    public function fields()
    {
        $fields = [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of user',
            ],
            'usuario' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The username of user',
//                'resolve'=>function($root,$args){
//                    return strtolower($root->username);
//                },
            ],
        ];
        return $this->_fields($fields);
    }
}