<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\EventController;

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
Route::post('login', [ApiController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'v1'], function() {
    //Route::get('signout', [ApiController::class, 'signout']);
    Route::get('events', [EventController::class, 'getEvents']);
    Route::get('events/active-events', [EventController::class, 'activeEvent']);
    Route::get('events/{id}', [EventController::class, 'getEventById']);
    Route::post('event/create', [EventController::class, 'createEvent']);
    Route::put('event/edit/{id}',  [EventController::class, 'EditEventById']);
    Route::delete('event/delete/{id}',  [EventController::class, 'deleteEventById']);
});
