<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 21/09/2017
 * Time: 03:15 PM
 */

namespace App\GraphQL\traits;


use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Rebing\GraphQL\Error\ValidationError;
use Rebing\GraphQL\Support\Type as GraphQLType;
trait GraphQLGlobalTrait
{
    protected function _validate($args){

        $messages=$this->_messages();
        $rules=$this->_rules();

        $messages=array_merge(
            [
                'required'=>'El campo :attribute es requerido',
                'email'=>'El campo :attribute debe ser un email válido'
            ],
            $messages
        );
        $v=Validator::make($args,$rules,$messages);
        if($v->fails()){
            throw with(new ValidationError('validation'))->setValidator($v);
        }
    }
    /**
     * @return array Returns the original attributes.
     */
    public function _getOriginalAttributes(GraphQLType $type){
        $attributes=[];
        $fields=$type->fields();

        foreach ($fields as $key => $value){
            if(isset($value['col'])){
                $attributes[$key]=$value['col'];
            }

        }
        return $attributes;
    }
    /**
     * @return array Returns the transformed attributes.
     */
    public function _getTransformedAttributes(GraphQLType $type){
        $attributes=$this->_getOriginalAttributes($type);
        return array_flip($attributes);
    }

    /**
     * @return string|null Returns the original attr on success and NULL on failure.
     */
    public function _getOriginalAttr($index,GraphQLType $type){
        $attributes=$this->_getOriginalAttributes($type);
        return (isset($attributes[$index])) ? $attributes[$index] : null;
    }

    /**
     * @return string|null Returns the transformed attr on success and NULL on failure.
     */
    public function _getTransformedAttr($index,GraphQLType $type){
        $attributes=$this->_getOriginalAttributes($type);
        return (isset($attributes[$index])) ? $attributes[$index] : null;
    }

    /**
     * @return array|null Returns the original columns with its values.
     */
    public function _argsToColumns(Array $args,GraphQLType $type){
        $fields=[];
        $typeFields=$type->fields();
        foreach($args as $arg=>$value){
            if(isset($typeFields[$arg])){
                $col=$typeFields[$arg]['col'];
                $fields[$col]=$value;
            }
        }
        return $fields;
    }


    public function _showError($message='',$code=500){
        throw new Exception($message,$code);
    }
}