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
use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Session;



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

Route::get('/delivery/create', [DeliveryController::class, 'show'])->name('showissueToken');
Route::get('/delivery/issue-token', [DeliveryController::class, 'issueTokenGenerate'])->name('generate.token');
Route::post('/delivery/issue-token', [DeliveryController::class, 'issueToken'])->name('issue.token');

Route::post('/delivery/create-order', [DeliveryController::class, 'createOrder'])->name('create.order');
Route::get('/cities', [DeliveryController::class, 'fetchCities']);
Route::get('/zones/{cityId}', [DeliveryController::class, 'fetchZones']);
Route::get('/areas/{zoneId}', [DeliveryController::class, 'fetchAreas']);
Route::get('/stores', [DeliveryController::class, 'fetchStores']);
Route::post('/calculate-shipping', [DeliveryController::class, 'calculateShipping'])->name('calculate.shipping');
Route::get('/shippingPriceCalculate', function () {
    return view('test.priceCalculate');
});




Route::resource('backEnd/products', ProductController::class);

Route::put('/backEnd/products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
Route::put('/backEnd/products/{product}/sale', [ProductController::class, 'updateOffer'])->name('products.updateOffer');

Route::resource('backEnd/categories', CategoryController::class);

Route::resource('backEnd/sliders', SliderController::class);

Route::resource('backEnd/orders', AdminOrderController::class);

Route::post('backEnd/orders/{productId}/{sizeId}/update', [AdminOrderController::class, 'updateOrderProduct'])->name('admin.order.update');
Route::post('backEnd/orders/{productId}/{sizeId}', [AdminOrderController::class, 'deleteOrderProduct'])->name('admin.order.delete');


Route::get('backEnd/siteSettings', [SiteSettingController::class, 'index'])->name('settings.index');
Route::put('backEnd/siteSettings', [SiteSettingController::class, 'update'])->name('settings.update');


Route::get('/backEnd', [App\Http\Controllers\DashboardController::class, 'root'])->name('dashboard');
Route::get('/backEnd/x/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');



Route::get('/', [HomeController::class, 'index'])->name('index');


// Route::resource('orders', OrderController::class);

Route::get('/collections/{category:slug}/{product:slug}', [HomeController::class, 'show'])->name('products.details');


Route::get('/collections/{category:slug}', [HomeController::class, 'showCategory'])->name('category.products');


// Route::get('/checkout',  function () {
//     return view('test.success');
// });


Route::post('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success'); // Added POST support

Route::post('/payment/fail', [PaymentController::class, 'paymentFail'])->name('payment.fail');
Route::post('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
Route::post('/payment/ipn', [PaymentController::class, 'paymentIpn'])->name('payment.ipn');  // For IPN (Instant Payment Notification)

Route::get('/order/{order:ref}/success', [OrderController::class, 'orderPlaced'])->name('order.placed')->middleware('checkOrderAccess');


Route::get('/cart', [OrderController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update/{index}', [OrderController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/remove/{index}', [OrderController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/count', function () {
    return response()->json(['count' => count(Session::get('cart', []))]);
});

Route::get('/checkout', [PaymentController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout', [PaymentController::class, 'processCheckout'])->name('checkout.process');  // Handle form submission

// Route::post('/cart/update', [OrderController::class, 'update'])->name('cart.update');
// Route::get('/cart/remove/{key}', [OrderController::class, 'remove'])->name('cart.remove');

// Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout');
// Route::post('/checkout/process', [OrderController::class, 'checkout.process'])->name('checkout.process');







