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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


$api = app('Dingo\Api\Routing\Router');

 // Controllers namespaces
 $controllers =[
     'auth' => 'App\Api\Controllers\AuthController',
     'user' => 'App\Api\Controllers\UserController',
     'fraud' => 'App\Api\Controllers\FraudController',
     'home' => 'App\Api\Controllers\HomeController',
    ];


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$api->version('v1', function ($api) use($controllers){

//prefix is api/v1
    $api->group(['prefix' => 'v1', 'middleware' => 'cors'], function ($api) use ($controllers){
       
            $api->post('register', [ 'uses' => $controllers['user'].'@storeUser']);
            $api->post('authenticate', [ 'uses' => $controllers['auth'].'@authenticate']);
            $api->get('user', ['uses'=> $controllers['user'].'@index']);
            $api->get('users', ['uses'=> $controllers['user'].'@getUsers']);
            $api->get('edit/users', ['uses'=> $controllers['user'].'@getUsers']);
            $api->post('edit/{id}', ['uses' =>  $controllers['user'] .'@updateUser']);
           
            $api->delete('/delete/{id}', [ 'uses' =>  $controllers['user'] .'@destroyUser']); 
           
            $api->post('fraud/case', [ 'uses' => $controllers['fraud'].'@storeFraud']);

            
            $api->get('me', ['uses'=> $controllers['user'].'@me']);
            
            $api->delete('/deletecase/{id}', [ 'uses' => $controllers['fraud'].'@deleteFraud']);
            
            $api->get('banks', [ 'uses' => $controllers['home'].'@getBanks']);
            $api->get('severities', [ 'uses' => $controllers['home'].'@getSeverities']);
            $api->get('itemtypes', [ 'uses' => $controllers['home'].'@getItemTypes']);
            $api->get('fraud/categories', [ 'uses' => $controllers['home'].'@getFraudCategories']);


    });


    $api->group(['middleware' => 'jwt.auth'], function($api) use ($controllers){

			$api->group(['prefix' => 'v1'], function($api) use ($controllers)
			{
				 $api->get('/me', ['as' => 'user.me', 'uses' =>  $controllers['user'] .'@authenticatedUser']);
            });
    });
});