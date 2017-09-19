<?php

namespace App\GraphQL\Query;

use App\GraphQL\GraphQLTrait;
use App\GraphQL\Type\PersonalType;
use App\models\Personal;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;


class PersonalsQuery extends Query
{
    use GraphQLTrait;
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
            'id' => ['name' => 'id', 'type' => Type::int()],
            'nombre' => ['type' => Type::string()],
            'apellido' => ['type' => Type::string()],
            'correo' => ['type' => Type::string()],
            'DNI' => ['type' => Type::string()],

            'limit' => ['name' => 'limit', 'type' => Type::int()],
            'page' => ['name' => 'page', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {

        $where = ['id', 'DNI'];
        $whereLike = ['nombre', 'apellido', 'correo'];
        $personalType = new PersonalType();

        $selects = $this->_getSelects($fields->getSelect(), $personalType);
        $cols = $this->_getCols($args, $personalType);

        $q = Personal::with($fields->getRelations())
            ->select($selects);

        foreach ($where as $w) {
            $key = $w;
            if (isset($args[$key])) {
                $col = $cols[$key];
                $q->where($col, $args[$key]);
            }
        }

        foreach ($whereLike as $wl) {
            $key = $wl;
            if (isset($args[$key])) {
                $col = $cols[$key];
                $like = $args[$key];
                $q->where($col, 'like', "%$like%");
            }
        }

        return $q->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}