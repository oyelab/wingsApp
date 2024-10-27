<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\PathaoWebhookController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;

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

Route::resource('backEnd/sliders', SliderController::class);

Route::resource('backEnd/orders', AdminOrderController::class);

Route::get('backEnd/siteSettings', [SiteSettingController::class, 'index'])->name('settings.index');
Route::put('backEnd/siteSettings', [SiteSettingController::class, 'update'])->name('settings.update');


Route::get('/backEnd', [App\Http\Controllers\DashboardController::class, 'root']);
Route::get('/backEnd/x/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');



Route::get('/', [HomeController::class, 'index'])->name('index');


// Route::resource('orders', OrderController::class);

Route::get('/collections/{category:slug}/{product:slug}', [HomeController::class, 'show'])->name('products.details');


Route::get('/collections/{category:slug}', [HomeController::class, 'showCategory'])->name('category.products');


// Route::get('/checkout',  function () {
//     return view('test.success');
// });
Route::get('/checkout', [PaymentController::class, 'checkout']);

Route::post('/checkout', [PaymentController::class, 'processCheckout'])->name('process.Checkout');  // Handle form submission

Route::post('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success'); // Added POST support

Route::post('/payment/fail', [PaymentController::class, 'paymentFail'])->name('payment.fail');
Route::post('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
Route::post('/payment/ipn', [PaymentController::class, 'paymentIpn'])->name('payment.ipn');  // For IPN (Instant Payment Notification)



Route::get('/cart', [OrderController::class, 'index'])->name('cart.view');
Route::get('/order/{order:ref}/success', [OrderController::class, 'orderPlaced'])->name('order.placed')->middleware('checkOrderAccess');

Route::post('/customerRegister', [CustomerController::class, 'customerRegister'])->name('customer.register');

// Route::post('/cart/add', [OrderController::class, 'add'])->name('cart.add');
// Route::post('/cart/update', [OrderController::class, 'update'])->name('cart.update');
// Route::get('/cart/remove/{key}', [OrderController::class, 'remove'])->name('cart.remove');

// Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout');
// Route::post('/checkout/process', [OrderController::class, 'checkout.process'])->name('checkout.process');







