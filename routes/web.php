<?php

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

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'DONE';
});

Route::get('/', function () {
    return view('login');
});

Route::resource('/akun', 'AkunController');
Route::resource('/order', 'OrderController');

Route::post('actionlogin', [LoginController::class, 'login_admin'])->name('login_admin');
Route::get('home', [HomeController::class, 'home'])->name('home')->middleware('auth');
Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

//route api
Route::post('/login', 'LoginController@index');
Route::get('/updateUser', 'UpdateUserController@index');
Route::get('/profileUser', 'ProfileController@index');