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


$api = app('Dingo\Api\Routing\Router');

/*
|Controllers namespaces
*/
$controllers =[
'auth' => 'App\Api\Controllers\AuthController',
'user' => 'App\Api\Controllers\UserController',
'fraud' => 'App\Api\Controllers\FraudController',
'home' => 'App\Api\Controllers\HomeController',
'flag' => 'App\Api\Controllers\CommentController',
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

    /*
    | API routes
    | prefix is api/v1
    */
    $api->group(['prefix' => 'v1', 'middleware' => 'cors'], function ($api) use ($controllers){

        /**
        * Unprotected Routes
        *
        * Fraud Case routes
        */
        $api->group(['prefix' => 'frauds'], function($api) use ($controllers)
        {
            $api->get('/', [ 'uses' => $controllers['fraud'].'@showFrauds']);
            $api->post('/', [ 'uses' => $controllers['fraud'].'@storeFraud']);
            $api->get('search', [ 'uses' => $controllers['fraud'].'@searchFraud']);
            $api->put('{fraud}', ['uses' =>  $controllers['fraud'] .'@updateFraud']);
            $api->delete('{fraud}', [ 'uses' => $controllers['fraud'].'@deleteFraud']);


            $api->get('categories', [ 'uses' => $controllers['home'].'@getFraudCategories']);
        });



        $api->get('/banks', [ 'uses' => $controllers['home'].'@getBanks']);
        $api->get('/itemtypes', [ 'uses' => $controllers['home'].'@getItemTypes']);
        $api->get('/severities', [ 'uses' => $controllers['home'].'@getSeverities']);

        $api->post('/comment', ['uses' => $controllers['flag'].'@flagFraud']);
        
        $api->get('/fraud/{fraud}', ['uses' => $controllers['fraud'].'@fraud']);
        $api->post('/', [ 'prefix' => 'users','uses' => $controllers['user'].'@storeUser']);
        $api->get('/user/{user}', [ 'prefix' => 'frauds', 'uses' => $controllers['user'].'@userFraud']);
        $api->post('/authenticate', [ 'prefix' => 'auth', 'uses' => $controllers['auth'].'@authenticate']);
        $api->post('/recoverpassword', [ 'prefix' => 'users', 'uses' => $controllers['user'].'@recoverPassword']);

        
        /*
        | User routes
        |
        | Protected Routes
        */
        $api->group(['middleware' => 'jwt.auth'], function($api) use ($controllers)
        {
            $api->group(['prefix' => 'users'], function($api) use ($controllers)
            {

                $api->get('/me', ['uses'=> $controllers['user'].'@index']);
                $api->put('{user}', ['uses' =>  $controllers['user'] .'@updateUser']);
                $api->delete('{user}', [ 'uses' =>  $controllers['user'] .'@destroyUser']); 
                $api->post('/me', ['uses' =>  $controllers['user'] .'@getAuthenticatedUser']);
            });
        });
    });
});

/*
| model bindings
*/
Route::model('user', 'Api\Models\User');
Route::model('fraud', 'Api\Models\FraudCase');