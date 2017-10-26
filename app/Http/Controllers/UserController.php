<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    
    public function getRegister()
    {
        return 'get user registration page';
    }

    public function getLogin()
    {
        return 'get user login page';
    }

    public function getLogout()
    {
        //todo:
        return 'logs reporters out';
    }

    public function getReportPage()
    {
        return 'report fraud page';
    }

    public function getSearch()
    {
        return 'search area page';
    }

    public function recoverPassword()
    {
        return 'password recovery page';
    }

}
