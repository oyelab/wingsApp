<?php

use App\Models\Specification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\PathaoWebhookController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\ShowcaseController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\TestController;





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


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/new-file-upload', [TestController::class, 'create'])->name('create');
Route::post('/new-file-upload', [TestController::class, 'store'])->name('store');
Route::get('/invoice', [TestController::class, 'invoice'])->name('invoice');


Route::get('/search', [CategoryController::class, 'search'])->name('search');
Route::get('/collections', [CategoryController::class, 'frontShow'])->name('collections');
Route::get('/wings-edited', [CategoryController::class, 'wingsEdited'])->name('wings.edited');

Route::get('/collections/{category:slug}/{subcategory:slug}/{product:slug}', [ProductController::class, 'show'])->name('products.details');
Route::get('/sections/{section:slug}/{slug}', [SectionController::class, 'show'])->name('sections.products.details');

Route::get('/collections/{category:slug}', [CategoryController::class, 'mainCategory'])->name('category');
Route::get('/collections/{category:slug}/{subcategory:slug}', [CategoryController::class, 'subCategory'])->name('subcategory');
Route::get('/get-subcategories/{mainCategoryId}', [CategoryController::class, 'getSubcategories']);

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


Route::get('/cart', [OrderController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update/{index}', [OrderController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/remove/{index}', [OrderController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/count', function () {
    return response()->json(['count' => count(Session::get('cart', []))]);
});

Route::post('/voucher/apply', [VoucherController::class, 'applyVoucher'])->name('voucher.apply');
Route::post('/voucher/edit', [VoucherController::class, 'editVoucher'])->name('voucher.edit');
Route::post('/voucher/remove', [VoucherController::class, 'removeVoucher'])->name('voucher.remove');

Route::get('/checkout', [PaymentController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout', [PaymentController::class, 'processCheckout'])->name('checkout.process');  // Handle form submission
Route::post('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success'); // Added POST support
Route::post('/payment/fail', [PaymentController::class, 'paymentFail'])->name('payment.fail');
Route::post('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
Route::post('/payment/ipn', [PaymentController::class, 'paymentIpn'])->name('payment.ipn');  // For IPN (Instant Payment Notification)

Route::get('/order/{order:ref}/success', [OrderController::class, 'orderPlaced'])->name('order.placed');
Route::get('/order/{order:ref}/failed', [OrderController::class, 'orderFailed'])->name('order.failed');

Route::get('/help', [PageController::class, 'help'])->name('help.index');
// Route::get('help', [PageController::class, 'index'])->name('help.index');
Route::get('/getInTouch', [PageController::class, 'getInTouch'])->name('getInTouch');

Route::get('/sections', [SectionController::class, 'sections'])->name('sections');
Route::get('/sections/{section}', [SectionController::class, 'shopPage'])->name('shop.page');

Route::resource('backEnd/products', ProductController::class);

Route::get('/backEnd/sections', [SectionController::class, 'index'])->name('sections.index');
Route::get('/backEnd/sections/create', [SectionController::class, 'create'])->name('sections.create');
Route::post('/backEnd/sections', [SectionController::class, 'store'])->name('sections.store');
Route::get('/backEnd/sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
Route::put('/backEnd/sections/{section}/update', [SectionController::class, 'update'])->name('sections.update');
Route::delete('/backEnd/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy'); // New delete route


Route::put('/backEnd/products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
Route::put('/backEnd/products/{product}/sale', [ProductController::class, 'updateOffer'])->name('products.updateOffer');

Route::resource('backEnd/reviews', ReviewController::class);
Route::post('backEnd/reviews/{id}/update-status', [ReviewController::class, 'updateStatus'])->name('reviews.updateStatus');



Route::resource('backEnd/categories', CategoryController::class);

Route::resource('backEnd/sliders', SliderController::class);

Route::resource('backEnd/orders', AdminOrderController::class);

Route::resource('backEnd/vouchers', VoucherController::class);

Route::resource('backEnd/pages', PageController::class)->except(['help']);
Route::put('pages/{page}/update-type', [PageController::class, 'updateType'])->name('pages.update-type');
Route::put('pages/update-order', [PageController::class, 'updateOrder'])->name('pages.update-order');



Route::prefix('backEnd')->middleware(['auth'])->group(function() {
    Route::resource('assets', AssetController::class);
});

Route::get('/backEnd/specifications', [SpecificationController::class, 'index'])->name('specifications.index');
Route::post('/backEnd/specifications', [SpecificationController::class, 'store'])->name('specifications.store');
Route::post('/backEnd/specifications/update', [SpecificationController::class, 'update'])->name('specifications.update');
Route::delete('/backEnd/specifications/destroy', [SpecificationController::class, 'destroy'])->name('specifications.destroy');


// Route::get('/showcases', [ShowcaseController::class, 'showcases'])->name('showcases');
Route::get('/showcases/{slug}', [ShowcaseController::class, 'show'])->name('showcase.show');

Route::resource('backEnd/showcases', ShowcaseController::class);


Route::post('backEnd/orders/{productId}/{sizeId}/update', [AdminOrderController::class, 'updateOrderProduct'])->name('admin.order.update');
Route::post('backEnd/orders/{productId}/{sizeId}', [AdminOrderController::class, 'deleteOrderProduct'])->name('admin.order.delete');


Route::get('backEnd/siteSettings', [SiteSettingController::class, 'index'])->name('settings.index');
Route::put('backEnd/siteSettings', [SiteSettingController::class, 'update'])->name('settings.update');


Route::get('/backEnd', [App\Http\Controllers\DashboardController::class, 'root'])->name('dashboard');
Route::get('/monthly-data', [App\Http\Controllers\DashboardController::class, 'getMonthlyData'])->name('monthly.data');

// Route::get('/backEnd/x/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('back.index');

Route::get('/backEnd/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/backEnd/userOrders', [UserController::class, 'userOrders'])->name('user.orders');
Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');
