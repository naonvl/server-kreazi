<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\FirebaseController;

use App\Http\Controllers\AppsController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\OrderController;
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

//route prefix
// /api/admin/... route prefix utk admin
// /api/mitra/... route prefix utk mitra
// /api/client/... route prefix utk client

//route api
Route::get('/article', [ArticleController::class, 'index']);
Route::post('/routeMitra', [RouteController::class, 'index']); // list route subdomain mitra & page mitra

Route::post('/login', [LoginController::class, 'index']);
Route::post('/auth', [FirebaseController::class, 'auth']);//->middleware('auth');
Route::post('/register', [RegisterController::class, 'index']);
Route::post('/updateUser', [UpdateUserController::class, 'index'])->middleware('token');
Route::get('/profileUser', [ProfileController::class, 'index'])->middleware(Token::class);

//route admin
Route::get('/admin/tipe', [TokoController::class, 'get_tipe'])->middleware(Token::class);
Route::post('/admin/addTipe', [TokoController::class, 'add_tipe'])->middleware(Token::class);
Route::get('/admin/dropship', [TokoController::class, 'get_dropship'])->middleware(Token::class);
Route::post('/admin/addDropship', [TokoController::class, 'add_dropship'])->middleware(Token::class);
Route::post('/admin/editDropship', [TokoController::class, 'update_dropship'])->middleware(Token::class);

Route::get('/admin/allTemplate', [TokoController::class, 'get_template'])->middleware(Token::class);
Route::post('/admin/addTemplate', [TokoController::class, 'add_template'])->middleware(Token::class);
Route::post('/admin/editTemplate', [TokoController::class, 'update_template'])->middleware(Token::class);

//api admin & mitra
Route::get('/mitra/tipe', [TokoController::class, 'get_tipe'])->middleware(Token::class);
Route::get('/mitra/dropship', [TokoController::class, 'get_dropship'])->middleware(Token::class);
Route::get('/mitra/allTemplate', [TokoController::class, 'get_template'])->middleware(Token::class);

Route::get('/mitra/produkMitra/{uid}', [TokoController::class, 'produkMitra'])->middleware(Token::class);
Route::post('/mitra/addProduk_mitra', [TokoController::class, 'add_produk_mitra'])->middleware(Token::class);
Route::post('/mitra/editProduk_mitra', [TokoController::class, 'edit_produk_mitra'])->middleware(Token::class);

// Route::post('/toko', [TokoController::class, 'index'])->middleware(Token::class);
// Route::post('/bukaToko', [TokoController::class, 'buka_toko'])->middleware(Token::class);
// Route::get('/produk', [TokoController::class, 'produk'])->middleware(Token::class);
// Route::post('/addProduk', [TokoController::class, 'add_produk'])->middleware(Token::class);
Route::post('/addCustom', [TokoController::class, 'add_produk_custom'])->middleware(Token::class);
Route::post('/editCustom', [TokoController::class, 'update_produk_custom'])->middleware(Token::class);

Route::get('/transaction', [TrasanctionController::class, 'index'])->middleware(Token::class);
Route::post('/withdraw', [TrasanctionController::class, 'withdraw'])->middleware(Token::class);

Route::post('/bayarSub', [TrasanctionController::class, 'bayar_subscribe'])->middleware(Token::class);

//api set cms home
Route::get('/imageBanner', [AppsController::class, 'index']);
Route::get('/productBanner', [AppsController::class, 'product']);
Route::get('/omichannel', [AppsController::class, 'omichannel']);
Route::get('/paymentMethod', [AppsController::class, 'payment_method']);
Route::get('/ContentRegister', [AppsController::class, 'content_register']);

Route::post('/add_imageBanner', [AppsController::class, 'add_imageBanner'])->middleware(Token::class);
Route::post('/add_productBanner', [AppsController::class, 'add_product'])->middleware(Token::class);
Route::post('/add_omichannel', [AppsController::class, 'add_omichannel'])->middleware(Token::class);
Route::post('/add_paymentMethod', [AppsController::class, 'add_payment_method'])->middleware(Token::class);

Route::post('/delete_imageBanner', [AppsController::class, 'delete_imageBanner'])->middleware(Token::class);
Route::post('/delete_productBanner', [AppsController::class, 'delete_product'])->middleware(Token::class);
Route::post('/delete_omichannel', [AppsController::class, 'delete_omichannel'])->middleware(Token::class);
Route::post('/delete_paymentMethod', [AppsController::class, 'delete_payment_method'])->middleware(Token::class);

//api customer
Route::post('/order', [OrderController::class, 'index'])->middleware(Token::class);             //buat bikin order dan cart pertama
Route::post('/addCart', [OrderController::class, 'add_cart'])->middleware(Token::class);        //buat add cart ke orderan yg sudah ada
Route::post('/getOrder', [OrderController::class, 'get_order'])->middleware(Token::class);      //buat ambil order yang dibuat oleh customer
Route::post('/deleteCart', [OrderController::class, 'delete_cart'])->middleware(Token::class);  //buat delete cart di list order
Route::post('/deleteOrder', [OrderController::class, 'delete_order'])->middleware(Token::class);//buat delete order

Route::post('/payment', [OrderController::class, 'payment'])->middleware(Token::class);
Route::post('/paymentDuitku', [OrderController::class, 'payment_duitku'])->middleware(Token::class);
Route::post('/paymentMidtrans', [OrderController::class, 'payment_midtrans'])->middleware(Token::class);

Route::post('/profileCust', [CustomerController::class, 'index'])->middleware(Token::class);
Route::post('/editProfile', [CustomerController::class, 'edit_profile'])->middleware(Token::class);
Route::post('/registerCust', [CustomerController::class, 'add_profile']);
