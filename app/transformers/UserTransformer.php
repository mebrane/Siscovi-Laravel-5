<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 26/08/2017
 * Time: 07:41 PM
 */

namespace App\transformers;


use App\models\auth\User;
use App\traits\TransformersTrait;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    use TransformersTrait;
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'personal'
    ];


    public function transform(User $user){

        $response=[
            '_id'      => (int) $user->id,
            'usuario'   => $user->username,
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => route('users.show', $user->id),
                ]
            ],
        ];

        return $this->addTransformerConstants($response,$user);
    }

    /**
     * Include Personal
     *
     * @return Item
     */
    public function includePersonal(User $user)
    {
        $personal = $user->personal;

        return $this->item($personal, new PersonalTransformer);
    }

//    public static function originalAttribute($index)
//    {
//        $attributes = [
//            '_id' => 'id',
//            'name' => 'name',
//            'email' => 'email',
//            'isVerified' => 'verified',
//            'isAdmin' => 'admin',
//            'creationDate' => 'created_at',
//            'lastChange' => 'updated_at',
//            'deletedDate' => 'deleted_at',
//        ];
//        return isset($attributes[$index]) ? $attributes[$index] : null;
//    }
}