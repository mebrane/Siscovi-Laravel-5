<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 26/08/2017
 * Time: 07:41 PM
 */

namespace App\transformers;


use App\models\auth\User;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class UserTransformer extends BaseTransformer
{

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
                    'uri' => '/users/'.$user->id,
                ]
            ],
        ];

        $constants = $this->datesTransformer($user);
        $return = array_merge($response,$constants);
////        if($user->personal){
//            $return['personal']=
//                //$user->personal;
//                $this->item($user->personal,new PersonalTransformer);
////        }

        return $return;
    }

    /**
     * Include Author
     *
     * @return Item
     */
    public function includePersonal(User $user)
    {
        $personal = $user->personal;

        return $this->item($personal, new PersonalTransformer);
    }
}