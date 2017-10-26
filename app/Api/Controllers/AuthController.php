<?php

namespace App\Api\Controllers;

use JWTAuth;
use App\Api\Models\User;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Api\Models\Authentication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use App\Api\Transformers\UserTransformer;
use Tymon\JwTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthController extends Controller
{
    use Helpers;

    /**
     * Authentication model instance
     *
     * @var Authentication
    */
    private $authenticationModel;

    /**
     * User model instance
     *
     * @var User
    */
    private $userModel;


    /**
     * Class constructor
     *
     * @param User $userModel
     * @param Authentication $authenticationModel
     */
    public function __construct(User $userModel, Authentication $authenticationModel)
    {
        $this->userModel = $userModel;
        $this->authenticationModel = $authenticationModel;
    }


    /**
     * Logs user to system using basic credentials
     *
     * @throws Exception
     *
     * @return array
     */
    public function authenticate(Request $request)
    {
        try
        {
            $credentials = $request->only('email', 'password');
            $email = $credentials['email'];
            $user = $this->userModel->where(['email' => $email])->first(); 

            if($user == null)
            {
                return response()->json(['error' => 'User does not exist.']);
            }

            if (!$token = JWTAuth::attempt($credentials)) 
            {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } 
        catch (JWTException $e)
        {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        //token generated, store it in the database
        $this->authenticationModel->store($user->id, $token);

        // all good so return the token
        return response()->json(compact('token'));
    }
}