<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 27/08/2017
 * Time: 03:20 PM
 */

namespace App\traits;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait TransformersTrait
{
//    protected function addTransformerConstants(Array $response, Model $model)
//    {
//        $constants = [
//            'actualizacion' => (string)$model->updated_at,
//            'registro' => (string)$model->created_at,
//        ];
//
//        if ($model->deleted_at) {
//            $constants['eliminado'] = (string)$model->deleted_at;
//        }
//        return array_merge($response, $constants);
//    }
//
//    public function getOriginalAttr($index){
//        $attributes=array_flip($this->attributes);
//        return isset($attributes[$index]) ? $attributes[$index] : null;
//    }
//
//    public function getTransformedAttr($index){
//        $attributes=$this->attributes;
//        return isset($attributes[$index]) ? $attributes[$index] : null;
//    }
}