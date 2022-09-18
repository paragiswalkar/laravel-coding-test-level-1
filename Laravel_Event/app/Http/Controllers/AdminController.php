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
use App\Models\Services;
use App\Models\Locations;
use App\Models\Documents;

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

    public function getServices() {
        //\DB::connection()->enableQueryLog();
        $getServices = Services::get()->toArray();
        $results = array();
        //dd($getServices);
        //$queries = \DB::getQueryLog();
        foreach($getServices as $i=>$service) {
                $locations = Locations::with(['documents' => function ($query) use($service) {
                    $query->whereIn('services_id',[$service['id']]);
                }])->get()->toArray();
                $results[$i] = $service;
                foreach($locations as $j=>$location) {
                    if(!Empty($location['documents'])) {
                        $results[$i]['locations'][] = $location;
                    }
                }
                
        }
        //$queries = \DB::getQueryLog();
        //dd($results); 
        return $results;
    }
}
