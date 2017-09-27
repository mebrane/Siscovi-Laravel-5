<?php

namespace App\GraphQL\Query\user;

use App\models\auth\User;
use App\GraphQL\traits\GraphQLQueryTrait;
use GraphQL;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class UsersQuery extends Query
{
    use GraphQLQueryTrait;
    protected $attributes = [
        'name' => 'UsersQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::paginate('user');
    }

    public function args()
    {
        return [
            'usuario' => ['type' => Type::string()],

            'limit' => ['name' => 'limit', 'type' => Type::int()],
            'page' => ['name' => 'page', 'type' => Type::int()],
            'sort' => ['name' => 'sort', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $q = new User();
        $where = [];
        $whereLike = ['usuario'];
        $sort = ['id','usuario','creado','eliminado','actualizado'];

        $q->with($fields->getRelations());
        $q->select($fields->getSelect());

        $q=$this->_where($q,$args,$where);
        $q=$this->_whereLike($q,$args,$whereLike);

        if (isset($args['sort'])) {
            $q=$this->_sortData($q,$args['sort'],$sort);
        }

        return $q->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}