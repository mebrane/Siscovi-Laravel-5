<?php

namespace App\GraphQL\Query\personal;

use App\GraphQL\traits\GraphQLQueryTrait;
use App\GraphQL\Type\PersonalType;
use App\models\Personal;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use GraphQL;
class PersonalQuery extends Query
{
    use GraphQLQueryTrait;
    protected $attributes = [
        'name' => 'PersonalQuery',
        'description' => 'A query'
    ];

    public function type()
    {
//        return Type::listOf(Type::string());
        return GraphQL::type('personal');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $q = Personal::with($fields->getRelations());

        $q=$this->_selectData($q,$fields->getSelect());
        $q->where('id',$args['id']);
        $r=$q->first();
        if(!$r){
            throw new \Exception("Personal no encontrado");
        }
        return $r;
    }
}