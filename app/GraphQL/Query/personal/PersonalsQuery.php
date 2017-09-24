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
//        $this->_showError(implode(",",$fields->getSelect()) );
        $q = new Personal();
        $where = ['DNI'];
        $whereLike = ['nombre', 'apellido', 'correo'];
        $sort = ['id','nombre', 'apellido', 'correo','creado','eliminado','actualizado'];

        $q = $q->with($fields->getRelations());
        $q=$this->_selectData($q,$fields->getSelect());

//        $this->_showError($q->toSql());
        $q=$this->_where($q,$args,$where);
        $q=$this->_whereLike($q,$args,$whereLike);

        if (isset($args['sort'])) {
            $q=$this->_sortData($q,$args['sort'],$sort);
        }

        return $q->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}