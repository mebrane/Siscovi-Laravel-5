<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 26/08/2017
 * Time: 08:19 PM
 */

namespace App\transformers;


//use Illuminate\Database\Schema\Blueprint;
//use Dingo\Blueprint\Blueprint;
use App\traits\TransformersTrait;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    protected $attributes=[];

    protected function addTransformerConstants(Array $response, Model $model)
    {
        $constants = [
            'actualizacion' => (string)$model->updated_at,
            'registro' => (string)$model->created_at,
        ];

        if ($model->deleted_at) {
            $constants['eliminado'] = (string)$model->deleted_at;
        }
        return array_merge($response, $constants);
    }

    public function getOriginalAttr($index){
        $attributes=array_flip($this->attributes);
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public function getTransformedAttr($index){
        $attributes=$this->attributes;
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}