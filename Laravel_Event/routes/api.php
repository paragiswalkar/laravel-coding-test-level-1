<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'v1'], function() {
    Route::get('events', [ApiController::class, 'logout']);
    Route::get('events/active-events', [ApiController::class, 'active_events']);
    Route::get('events/{id}', [ApiController::class, 'Show']);
});
