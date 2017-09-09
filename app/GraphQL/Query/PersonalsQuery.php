<?php

namespace App\GraphQL\Query;

use App\models\Personal;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class PersonalsQuery extends Query
{
    protected $attributes = [
        'name' => 'PersonalsQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('personal'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'nombre' => ['name' => 'nombre', 'type' => Type::string()],
            'dni' => ['name' => 'dni', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
//        $select = $fields->getSelect();
//        $with = $fields->getRelations();

//        return Post::with($fields->getRelations())->select($fields->getSelect())
//            ->paginate($args['limit'], ['*'], 'page', $args['page']);
//
//        return [];

        $q=new Personal();

        if(isset($args['id']))
        {
            $q=$q->where('id' , $args['id']);
        }

        if(isset($args['nombre']))
        {
            $name=$args['nombre'];
            $q=$q->where('name', 'like',"%$name%");
        }

        if(isset($args['dni']))
        {
            $like=$args['dni'];
            $q=$q->where('dni', 'like',"%$like%");
        }
        return $q->get();
    }
}