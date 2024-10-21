<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SslCommerzPaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();


Route::resource('backEnd/products', ProductController::class);

Route::put('/backEnd/products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
Route::put('/backEnd/products/{product}/sale', [ProductController::class, 'updateOffer'])->name('products.updateOffer');

Route::resource('backEnd/categories', CategoryController::class);

// Route::resource('backEnd/settings', SettingController::class);

Route::resource('backEnd/sliders', SliderController::class);


Route::get('/backEnd', [App\Http\Controllers\DashboardController::class, 'root']);
Route::get('/backEnd/x/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');



Route::get('/', [HomeController::class, 'index'])->name('index');

// Route::resource('orders', OrderController::class);

Route::get('/collections/{category:slug}/{product:slug}', [HomeController::class, 'show'])->name('products.details');


Route::get('/collections/{category:slug}', [HomeController::class, 'showCategory'])->name('category.products');


Route::get('/cart', [OrderController::class, 'index'])->name('cart.view');
Route::post('/cart/add', [OrderController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [OrderController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{key}', [OrderController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout');
Route::post('/checkout/process', [OrderController::class, 'checkout.process'])->name('checkout.process');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END







