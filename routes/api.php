<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\FirebaseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route api
Route::post('/login', [LoginController::class, 'index']);
Route::post('/updateUser', [UpdateUserController::class, 'index']);
Route::get('/profileUser', [ProfileController::class, 'index']);
Route::get('/article', [ArticleController::class, 'index']);
Route::get('/routeMitra', [RouteController::class, 'index']); // list route subdomain mitra & page mitra

Route::post('/auth', [FirebaseController::class, 'auth']);//->name('verify')->middleware('token');