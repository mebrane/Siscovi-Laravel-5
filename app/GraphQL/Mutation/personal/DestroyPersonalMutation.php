<?php

namespace App\GraphQL\Mutation\personal;

use App\GraphQL\traits\GraphQLGlobalTrait;
//use App\GraphQL\traits\GraphQLMutationTrait;
use App\models\Personal;
use GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DestroyPersonalMutation extends Mutation
{
    use GraphQLGlobalTrait;
//    use GraphQLMutationTrait;
    protected $attributes = [
        'name' => 'DestroyPersonalMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
//        return Type::listOf(Type::string());
        return GraphQL::type('personal');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
      ];
    }

    private function _rules($args){
        return [];
    }

    private function _messages(){
        return [];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $q= Personal
                ::with($with)
                ->select($select)
                ->find($args['id']);

        if(!$q){
            $this->_showError("Personal no encontrado");
        }

        $q->delete();

        return $q;
    }
}