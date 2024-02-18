<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\FirebaseController;

use App\Http\Controllers\TokoController;
use App\Http\Controllers\TrasanctionController;

use App\Http\Middleware\Token;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//route api
Route::get('/article', [ArticleController::class, 'index']);
Route::get('/routeMitra', [RouteController::class, 'index']); // list route subdomain mitra & page mitra

Route::post('/login', [LoginController::class, 'index'])->middleware('auth');
Route::post('/auth', [FirebaseController::class, 'auth'])->middleware('auth');
Route::post('/register', [RegisterController::class, 'index']);
Route::post('/updateUser', [UpdateUserController::class, 'index'])->middleware(Token::class);
Route::get('/profileUser', [ProfileController::class, 'index'])->middleware(Token::class);

//api tenant
Route::get('/toko', [TokoController::class, 'index'])->middleware(Token::class);
// Route::post('/bukaToko', [TokoController::class, 'buka_toko'])->middleware(Token::class);
Route::get('/produk', [TokoController::class, 'produk'])->middleware(Token::class);
Route::post('/addProduk', [TokoController::class, 'add_produk']);//->middleware(Token::class);
Route::post('/customProduk', [TokoController::class, 'custom_produk'])->middleware(Token::class);
Route::post('/editProduk', [TokoController::class, 'update_produk'])->middleware(Token::class);

Route::get('/transaction', [TrasanctionController::class, 'index'])->middleware(Token::class);
Route::post('/withdraw', [TrasanctionController::class, 'withdraw'])->middleware(Token::class);

Route::post('/bayarSub', [TrasanctionController::class, 'bayar_subscribe'])->middleware(Token::class);

//api customer
Route::post('/order', [OrderController::class, 'index'])->middleware(Token::class);
Route::post('/cart', [OrderController::class, 'add_cart'])->middleware(Token::class);
Route::post('/delete_cart', [OrderController::class, 'delete_cart'])->middleware(Token::class);
Route::post('/payment', [OrderController::class, 'payment'])->middleware(Token::class);
Route::post('/paymentDuitku', [OrderController::class, 'payment_duitku'])->middleware(Token::class);
Route::post('/paymentMidtrans', [OrderController::class, 'payment_midtrans'])->middleware(Token::class);

Route::post('/profileCust', [CustomerController::class, 'index'])->middleware(Token::class);
Route::post('/editProfile', [CustomerController::class, 'edit_profile'])->middleware(Token::class);
Route::post('/registerCust', [CustomerController::class, 'add_profile']);