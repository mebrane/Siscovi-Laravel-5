<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 29/09/2017
 * Time: 11:37 PM
 */

namespace App\GraphQL\traits;


use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

trait ModelGlobalTrait
{

    use SoftDeletes;

//    use Eloquence;
//    use Mappable;

//    protected $maps;
//    protected $appends;
//    protected $dates = ['deleted_at'];

//    custom traits
    use EloquenceModelTrait;


}