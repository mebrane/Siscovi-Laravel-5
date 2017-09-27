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

trait GraphQLGlobalTrait
{
    protected function _validate($args=[]){

        $rules=$this->_rules($args);
        $messages=$this->_messages();

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


    public function _showError($message='',$code=500){
        if(is_array($message) or is_object($message)){
            $message=json_encode($message);
        }
        throw new Exception($message,$code);
    }

}