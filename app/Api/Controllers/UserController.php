<?php

namespace App\Api\Controllers;

use JWTAUth;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use Helpers;


     public function index()
    {
        return " and today will be called monday";
    }
    public function show()
    {
        return "today is tuesday and i am just checking in. albeit late in the day";
    }
}