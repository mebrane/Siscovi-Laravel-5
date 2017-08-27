<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 27/08/2017
 * Time: 12:40 AM
 */

namespace App\transformers;


use Illuminate\Database\Eloquent\Model;

class PersonalTransformer extends BaseTransformer
{
    public function transform(Model $model)
    {

        $response = [
            '_id' => (int)$model->id,
            'nombre' => $model->name,
            'apellido' => $model->lastName,
            'DNI' => $model->DNI,
            'nacimiento' => $model->birthDate,
            'contrato' => $model->contractDate,
            'sueldo' => $model->salary,
            'sexo' => $model->gender,
            'direccion' => $model->address,
            'telefono' => $model->phone,
            'correo' => $model->email,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/personal/' . $model->id,
                ]
            ],
        ];

        $constants = $this->datesTransformer($model);
        $return = array_merge($response, $constants);
//        if ($model->user) {
            $return['user'] =
                //$model->user;
                $this->item($model->user,new UserTransformer);

//        }

        return $return;
    }

}