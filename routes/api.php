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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


$api = app('Dingo\Api\Routing\Router');

 // Controllers namespaces
 $controllers =[
     'user' => 'App\Api\Controllers\UserController',
    ];


$api->version('v1', function ($api) use($controllers){

    $api->group(['prefix' => 'user', 'middleware' => 'cors'], function ($api) use ($controllers){
       
            $api->get('testing', [ 'uses' => $controllers['user'].'@index']);
            $api->get('tested', ['uses'=> $controllers['user'].'@show']);
    });
});