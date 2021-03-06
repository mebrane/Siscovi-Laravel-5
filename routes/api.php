<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('test',function(){
    return request()->query();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['middleware' => 'bindings'], function ($api) {

        $api->resource(
            'users',
            '\App\Http\Controllers\AuthREST\UserController',
            ['except' => ['create', 'edit']]
        );

        $api->resource(
            'personals',
            '\App\Http\Controllers\REST\PersonalController',
            ['except' => ['create', 'edit']]
        );

    });

});


