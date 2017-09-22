<?php

namespace App\GraphQL\Query\personal;

use App\GraphQL\traits\GraphQLQueryTrait;
use App\GraphQL\Type\PersonalType;
use App\models\Personal;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;


class PersonalsQuery extends Query
{
    use GraphQLQueryTrait;
    protected $attributes = [
        'name' => 'PersonalsQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::paginate('personal');
    }

    public function args()
    {
        return [
//            'id' => ['name' => 'id', 'type' => Type::int()],
            'nombre' => ['type' => Type::string()],
            'apellido' => ['type' => Type::string()],
            'correo' => ['type' => Type::string()],
            'DNI' => ['type' => Type::string()],

            'limit' => ['name' => 'limit', 'type' => Type::int()],
            'page' => ['name' => 'page', 'type' => Type::int()],
            'sort' => ['name' => 'sort', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $q = new Personal();
        $where = ['DNI'];
        $whereLike = ['nombre', 'apellido', 'correo'];
        $type = new PersonalType();

        $q = $q->with($fields->getRelations());
        $q = $this->_select($q, $fields->getSelect(), $type);

        $q=$this->_where($q,$args,$where,$type);
        $q=$this->_whereLike($q,$args,$whereLike,$type);

        if (isset($args['sort'])) {
            $q = $this->_sortBy($q, $args['sort'], $type);
        }

        return $q->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}