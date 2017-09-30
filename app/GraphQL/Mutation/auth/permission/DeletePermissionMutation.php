<?php

namespace App\GraphQL\Mutation\auth\permission;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeletePermissionMutation extends Mutation
{
    protected $attributes = [
        'name' => 'DeletePermissionMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::listOf(Type::string());
    }

    public function args()
    {
        return [

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return [];
    }
}