<?php

namespace App\GraphQL\Query\user;

use App\models\auth\User;
use App\GraphQL\traits\GraphQLQueryTrait;
//use App\GraphQL\Type\UserType;
use GraphQL;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class UserQuery extends Query
{
    use GraphQLQueryTrait;
    protected $attributes = [
        'name' => 'UserQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::type('user');
//        return GraphQL::type(UserType::class);
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $q = new User();

        $q
            ->with($fields->getRelations())
            ->select($fields->getSelect())
            ->where('id', $args['id']);
        $r = $q
            ->first();
        if (!$r) {
            $this->_showError("Usuario no encontrado",404);
        }
        return $r;
    }
}