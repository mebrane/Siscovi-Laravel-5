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
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    protected function datesTransformer(Model $model){
        return [
            'actualizado'    => $model->updated_at,
            'creado'    => $model->created_at,
            'eliminado'    => $model->deleted_at,
        ];
    }

}