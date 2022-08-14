<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $redirectTo = '/';
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function login()
    {
        return view("login");
    }

    public function events()
    {
        return view("dashboard");
    }
}
