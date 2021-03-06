<?php

namespace App\GraphQL\Mutation\personal;

use App\GraphQL\traits\GraphQLGlobalTrait;
//use App\GraphQL\traits\GraphQLMutationTrait;
use App\GraphQL\traits\GraphQLMutationTrait;
use App\GraphQL\Type\PersonalType;
use App\models\Personal;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;


class CreatePersonalMutation extends Mutation
{
    use GraphQLGlobalTrait;
    use GraphQLMutationTrait;
    protected $attributes = [
        'name' => 'CreatePersonalMutation',
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
            'nombre' => ['type' => Type::nonNull(Type::string())],
            'apellido' => ['type' => Type::nonNull(Type::string())],
            'correo' => ['type' => Type::nonNull(Type::string())],
            'DNI' => ['type' => Type::nonNull(Type::string())],
            'nacimiento' => ['type' => Type::nonNull(Type::string())],
            'contrato' => ['type' => Type::nonNull(Type::string())],
            'sueldo' => ['type' => Type::nonNull(Type::float())],
            'sexo' => ['type' => Type::nonNull(Type::string())],
            'direccion' => ['type' => Type::string()],
            'telefono' => ['type' => Type::string()],
        ];
    }

    private function _rules()
    {
        $mut = new UpdatePersonalMutation();
        $rules = $mut->_rules(['id' => 0]);
        $requiredExcept = ['id', 'telefono', 'direccion'];
        foreach ($rules as $key => $value) {
            if (!in_array($key, $requiredExcept)) {
                $value = is_array($value) ? $value : explode("|", $value);
                $rules[$key] = array_unshift($value, 'required');
                $rules[$key] = $value;
            }
        }
        unset($rules['id']);
        return $rules;
    }

    private function _messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'correo.unique' => 'El correo ya está en uso',
            'DNI.unique' => 'El DNI ya está en uso',
//            'DNI.numeric'=>'El DNI debe contener solo números',
            'DNI.digits' => 'El DNI debe ser numérico y tener :digits dígitos'
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $this->_validate($args);
//        $this->_showError($args);
//        $m = new Personal();
//        $_args = [
//            "nombre" => "dffdfsdf",
//            "apellido" => "sfdsfdsfdsfsd",
//            "nacimiento" => "1999-01-01",
//            "correo" => "dsdsdsd@ffds.dfd",
//            "DNI" => "44455567",
//            "contrato" => "2000-01-01",
//            "sueldo" => 2000,
//            "sexo" => "M",
//            "telefono" => "324434343",
//            "direccion" => "fdsfds"
//        ];

//        $p = new Personal();
//        $keys = array_flip($p->_fillable());
//        $_args = array_intersect_key($args,$keys);
//        $p->fill($_args );
//        $personal = $p->save();
        $p=$this->_fillOnIns(new Personal(),$args);
        $p->save();
        return $p;
    }
}