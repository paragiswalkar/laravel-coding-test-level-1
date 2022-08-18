<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('/',[LoginController::class, 'getLogin'])->name('adminLogin');
Route::post('/', [LoginController::class, 'postLogin'])->name('adminLoginPost');
Route::post('signout',[LoginController::class, 'destroy'])->name('signout');

Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {
	// Admin Dashboard
	Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
	Route::get('create-event', [AdminController::class, 'storeEvent'])->name('create-event');		
});

Auth::routes();
