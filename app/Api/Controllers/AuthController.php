<?php

namespace App\Api\Controllers;

use JWTAuth;
use App\Api\Models\User;
use App\Api\Models\Authentication;
use Dingo\Api\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JwTAuth\Exceptions\JWTException;
use App\Api\Transformers\UserTransformer;
use Dingo\Api\Routing\Helpers;

class AuthController extends Controller
{
    use Helpers;

    private $model;


    /**
     * API Login, on successreturn JWT Auth token
     *
     * @throws Exception
     *
     * @return \JsonResponse
     */
    public function authenticate(Request $request)
    {
        //grab credentials from the request
        $credentials = $request->only('email', 'password');

        try
        {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) 
            {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } 
        catch (JWTException $e)
        {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
       return response()->json(compact('token'));
    }


}