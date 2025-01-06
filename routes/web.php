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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\ShowcaseController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\GitController;
use App\Http\Controllers\SubscriptionController;





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

/* FrontEnd */
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/sections', [SectionController::class, 'sections'])->name('sections');
Route::get('/sections/{section}', [SectionController::class, 'shopPage'])->name('shop.page');
Route::get('/sections/{section:slug}/{slug}', [SectionController::class, 'show'])->name('sections.products.details');
Route::get('/collections', [CategoryController::class, 'frontShow'])->name('collections');
Route::get('/collections/{category:slug}', [CategoryController::class, 'categoryPage'])->name('category');
// Route::get('/collections/{category:slug}/{subcategory:slug}', [CategoryController::class, 'subCategory'])->name('subcategory');
Route::get('/collections/{category:slug}/{product:slug}', [ProductController::class, 'show'])->name('products.details');
Route::get('/wings-edited', [CategoryController::class, 'wingsEdited'])->name('wings.edited');

Route::get('/showcases/{slug}', [ShowcaseController::class, 'show'])->name('showcase.show');

Route::get('/cities', [DeliveryController::class, 'fetchCities']);
Route::get('/zones/{cityId}', [DeliveryController::class, 'fetchZones']);
Route::get('/areas/{zoneId}', [DeliveryController::class, 'fetchAreas']);
Route::get('/stores', [DeliveryController::class, 'fetchStores']);
Route::post('/calculate-shipping', [DeliveryController::class, 'calculateShipping'])->name('calculate.shipping');


Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');

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
Route::post('/payment/ipn', [PaymentController::class, 'ipn'])->name('payment.ipn');  // For IPN (Instant Payment Notification)

Route::get('/order/{order:ref}/success', [OrderController::class, 'orderPlaced'])->name('order.placed');
Route::get('/order/{order:ref}/failed', [OrderController::class, 'orderFailed'])->name('order.failed');

Route::get('/order/{order}/invoice', [OrderController::class, 'generateInvoice'])->name('order.invoice');

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

Route::get('/help', [PageController::class, 'help'])->name('help.index');
Route::get('/getInTouch', [PageController::class, 'getInTouch'])->name('getInTouch');
Route::post('/getInTouch', [PageController::class, 'postInTouch'])->name('postInTouch');

/* dashboard */
Route::prefix('dashboard')->middleware(['auth'])->group(function() {
	Route::get('/', [DashboardController::class, 'root'])->name('dashboard');
	Route::get('/monthly-data', [DashboardController::class, 'getMonthlyData'])->name('monthly.data');

	Route::get('specifications', [SpecificationController::class, 'index'])->name('specifications.index');
	Route::post('specifications', [SpecificationController::class, 'store'])->name('specifications.store');
	Route::post('specifications/update', [SpecificationController::class, 'update'])->name('specifications.update');
	Route::delete('specifications/destroy', [SpecificationController::class, 'destroy'])->name('specifications.destroy');
	Route::get('sections', [SectionController::class, 'index'])->name('sections.index');
	Route::get('sections/create', [SectionController::class, 'create'])->name('sections.create');
	Route::post('sections', [SectionController::class, 'store'])->name('sections.store');
	Route::get('sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
	Route::put('sections/{section}/update', [SectionController::class, 'update'])->name('sections.update');
	Route::delete('sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy'); // New delete route
	Route::get('siteSettings', [SiteSettingController::class, 'index'])->name('settings.index');
	Route::put('siteSettings', [SiteSettingController::class, 'update'])->name('settings.update');

	Route::get('/emails', [GitController::class, 'gits'])->name('gits.index');

	Route::post('/order/{order}/refund', [OrderController::class, 'refundStore'])->name('refund.store');
	Route::get('/orders/refunds', [OrderController::class, 'refunds'])->name('orders.refunds');
	Route::get('/orders/cancelled', [OrderController::class, 'cancelled'])->name('orders.cancelled');
	Route::get('/orders/completed', [OrderController::class, 'completed'])->name('orders.completed');

	Route::get('/collections/items', [ProductController::class, 'items'])->name('collections.item');

	Route::put('/products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
	Route::put('/products/{product}/sale', [ProductController::class, 'updateOffer'])->name('products.updateOffer');

	Route::post('/reviews/{id}/update-status', [ReviewController::class, 'updateStatus'])->name('reviews.updateStatus');

	Route::get('/profile', [UserController::class, 'profile'])->name('profile');
	Route::get('/userOrders', [UserController::class, 'userOrders'])->name('user.orders');
	Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');

	Route::get('/customers', [UserController::class, 'customerList'])->name('customer.list');

	Route::post('/orders/{productId}/{sizeId}/update', [AdminOrderController::class, 'updateOrderProduct'])->name('admin.order.update');

	Route::put('pages/{page}/update-type', [PageController::class, 'updateType'])->name('pages.update-type');
	Route::put('pages/update-order', [PageController::class, 'updateOrder'])->name('pages.update-order');
	Route::get('/get-subcategories/{mainCategoryId}', [CategoryController::class, 'getSubcategories']);



	Route::resource('assets', AssetController::class);
	Route::resource('showcases', ShowcaseController::class);
	Route::resource('categories', CategoryController::class);
	Route::resource('sliders', SliderController::class);
	Route::resource('orders', AdminOrderController::class);
	Route::resource('vouchers', VoucherController::class);
	Route::resource('reviews', ReviewController::class);
	Route::resource('products', ProductController::class);
	Route::resource('pages', PageController::class)->except(['help']);
});


Route::middleware(['auth', 'role'])->group(function () {
    // This route is for authenticated users with role 1
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show'])->name('subscriptions.show');
});

/* For Developer */
Route::get('/delivery/issue-token', [DeliveryController::class, 'issueTokenGenerate'])->name('generate.token');
Route::post('/delivery/issue-token', [DeliveryController::class, 'issueToken'])->name('issue.token');

Route::post('/delivery/create-order', [DeliveryController::class, 'createOrder'])->name('create.order');

// Route::post('dashboard/orders/{productId}/{sizeId}', [AdminOrderController::class, 'deleteOrderProduct'])->name('admin.order.delete');

Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('/test/new-file-upload', [TestController::class, 'create'])->name('test.create');
// Route::get('/devFImg', [TestController::class, 'devF'])->name('test.devF');
Route::post('/test/store', [TestController::class, 'store'])->name('test.store');
Route::get('/invoice', [TestController::class, 'generatePdf'])->name('test.invoice');