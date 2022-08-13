<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\Event;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function get_events(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $events = JWTAuth::authenticate($request->token);
 
        return response()->json(['event' => $events]);
    }
}
