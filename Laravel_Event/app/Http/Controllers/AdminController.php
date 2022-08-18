<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\Event;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $token = \Session::get('token');
        
        return view('home',['token' => $token]);
    }

    public function eventForm() {
        $token = \Session::get('token');
        return view('create',['token' => $token]);
    }

    public function eventEditForm($id) {
        $token = \Session::get('token');
        $events = new Event;
        $data = $events->find($id);
        
        return view('edit',['token' => $token,'event'=>$data]);
    }
}
