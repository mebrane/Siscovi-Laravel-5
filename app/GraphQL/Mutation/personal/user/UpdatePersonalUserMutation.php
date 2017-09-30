<?php

namespace App\GraphQL\Mutation\personal\user;

use App\GraphQL\traits\GraphQLGlobalTrait;
use App\GraphQL\traits\GraphQLMutationTrait;
use App\models\Personal;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdatePersonalUserMutation extends Mutation
{
    use GraphQLGlobalTrait,
        GraphQLMutationTrait;
    protected $attributes = [
        'name' => 'UpdatePersonalUserMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('personal');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'usuario' => ['type' =>Type::string()],
            'clave' => ['type' =>Type::string()],
        ];
    }

    public function _rules($args){
        return [
            'id' => 'required|numeric',
            'usuario' => [
                'min:3',
                'max:100',
                Rule::unique('users','username')
                    ->ignore($args['id'])
            ],
            'clave' => 'min:3|max:100',
        ];
    }

    private function _messages(){
        return [
            'id.required'=>'El id es requerido',
            'id.numeric'=>'El id debe ser numérico',
            'usuario.unique'=>'El usuario ya existe',
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $this->_validate($args);
        $p = Personal::find($args['id']);
        if(!$p) {
            $this->_showError("Personal no existe",404);
        }

        $u=$p->usuario()->withTrashed()->first();
        if(!$u){
            $this->_showError("Usuario no encontrado.");
        }

        $u=$p->usuario()->onlyTrashed()->first();
        if($u){
            $this->_showError("Usuario eliminado, ¿desea recuperar los datos?");
        }

        $u=$p->usuario()->first();

        $u=$this->_fillOnUpd($u,$args);

        if (!$u->isDirty()) {
            $this->_showError('Se debe especificar al menos un valor diferente para actualizar',422);
        }
        $u->save();

        return $p->with('usuario')->first();
    }
}