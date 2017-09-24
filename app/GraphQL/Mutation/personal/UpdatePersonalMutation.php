<?php

namespace App\GraphQL\Mutation\personal;

use App\GraphQL\traits\GraphQLMutationTrait;
use App\GraphQL\Type\PersonalType;
use App\models\Personal;
use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;
class UpdatePersonalMutation extends Mutation
{
    use GraphQLMutationTrait;
    protected $attributes = [
        'name' => 'UpdatePersonalMutation',
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
            'nombre' => ['type' =>Type::string()],
            'apellido' => ['type' =>Type::string()],
            'correo' => ['type' =>Type::string()],
            'DNI' => ['type' =>Type::string()],
            'sueldo' => ['type' =>Type::float()],
            'contrato' => ['type' =>Type::string()],
            'nacimiento' => ['type' =>Type::string()],
            'sexo' => ['type' =>Type::string()],
            'direccion' => ['type' =>Type::string()],
            'telefono' => ['type' =>Type::string()],
        ];
    }

    public function _rules($args){
        $tomorrow=Carbon::tomorrow();
        $today=Carbon::today();
        $years18ago=$today->subYear(18);

        return [
            'id' => 'required|numeric',
            'nombre' => 'min:3|max:100',
            'apellido' => 'min:3|max:100',
            'correo' => [
                'email',
                'min:3',
                'max:100',
                Rule::unique('personals','email')
                    ->ignore($args['id'])
            ],
            'DNI' => [
                'digits:8',
                'unique:personals,DNI,'.$args['id']
            ],
            'sueldo' => 'numeric|min:100|max:100000',
            'contrato' => "date|before:$tomorrow",
            'nacimiento' => "date|before:$years18ago",
            'sexo' => [Rule::in(['M','F'])],
            'direccion' => 'max:200',
            'telefono' => 'digits_between:0,50',
        ];
    }

    private function _messages(){
        return [];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $this->_validate($args);
        $model = Personal::find($args['id']);
        if(!$model) {
            $this->_showError("Personal no existe");
        }

        $model=$this->_fillOnUpd($model,$args);

        if (!$model->isDirty()) {
            $this->_showError('Se debe especificar al menos un valor diferente para actualizar',422);
        }
        $model->save();

        return $model;
    }
}