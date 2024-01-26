<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\hanyaTamuMiddleware;

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

Route::get('/', [HomeController::class, 'home']);

Route::view('/template', 'templates')->name('test-templates');

Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'login')->name('login.page')->middleware([hanyaTamuMiddleware::class]);
    Route::post('/login', 'doLogin')->name('login.post')->middleware([hanyaTamuMiddleware::class]);
    Route::post('/logout', 'doLogout')->name('logout');
});