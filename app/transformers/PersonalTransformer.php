<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 27/08/2017
 * Time: 12:40 AM
 */

namespace App\transformers;

use App\traits\TransformersTrait;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class PersonalTransformer extends BaseTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user'
    ];

    /**
     * Transform
     *
     * @return array
     */

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

        return $this->addTransformerConstants($response,$model);
    }

    /**
     * Include User
     *
     * @return Item
     */
    public function includeUser(Model $model)
    {
        $user = $model->user;

        return $this->item($user, new UserTransformer);
    }


    protected $attributes = [
        'id' => '_id',
        'name' => 'nombre',
        'lastName' => 'apellido',
        'DNI' => 'DNI',
        'birthDate' => 'nacimiento',
        'contractDate' => 'contrato',
        'gender'=>'sexo',
        'salary' => 'sueldo',
        'address' => 'direccion',
        'phone'=>'telefono',
        'email'=>'correo'
    ];


}