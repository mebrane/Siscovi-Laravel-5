<?php

namespace App\GraphQL\Query\personal;

use App\GraphQL\traits\GraphQLGlobalTrait;
use App\GraphQL\traits\GraphQLQueryTrait;
use App\models\Personal;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use GraphQL;
class PersonalQuery extends Query
{
    use GraphQLGlobalTrait;
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
        $q=new Personal();
        $notFoundMsg="Personal no encontrado";

        $q
            ->with($fields->getRelations())
            ->select($fields->getSelect());

        $r=$q->find($args['id']);
        if(!$r){
            throw new \Exception($notFoundMsg,404);
        }
        return $r;
    }
}