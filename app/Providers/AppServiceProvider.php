<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Models\Page;
use App\Models\Asset;
use App\Helpers\FilePathHelper;
use App\Services\OrderService;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;





class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->singleton(OrderService::class, function ($app) {
			$accessToken = SiteSetting::getPathaoAccessToken();
			// Pass empty string if no token found - OrderService should handle this gracefully
			return new OrderService(config('pathao.base_url'), $accessToken ?: '');
		});
	}

	/**
	 * Bootstrap any application services.
	 */
	// public function boot(): void
	// {
	//     Schema::defaultStringLength(191);
	// }

	public function boot()
	{
		Paginator::useBootstrapFive();

		// Skip database queries if tables don't exist (during migrations)
		if (!$this->tablesExist()) {
			return;
		}

		$assets = Asset::all();

		// Share global data with all views
		$settings = SiteSetting::first();
		$footerLinks = Page::where('type', 1)->orderBy('order', 'asc')->get();
		$quickLinks = Page::where('type', 2)->orderBy('order', 'asc')->get();

		$socialLinks = [];
		if ($settings && is_string($settings->social_links)) {
			$socialLinks = json_decode($settings->social_links, true) ?: [];
		} elseif ($settings && is_array($settings->social_links)) {
			$socialLinks = $settings->social_links;
		}

		$iconMapping = $settings->getSocialIconMapping();
		$cartCount = count(Session::get('cart', []));
		$baseUrl = request()->getSchemeAndHttpHost();


		// Share data globally with all views
		View::share([
			'siteSettings' => $settings,
			'socialLinks' => $socialLinks,
			'iconMapping' => $iconMapping,
			'cartCount' => $cartCount,
			'footerLinks' => $footerLinks,
			'quickLinks' => $quickLinks,
			'siteUrl' => $baseUrl,
			'assets' => $assets,
		]);
	}

	/**
	 * Check if required tables exist in the database
	 */
	private function tablesExist(): bool
	{
		try {
			return Schema::hasTable('pages') && Schema::hasTable('site_settings') && Schema::hasTable('assets');
		} catch (\Exception $e) {
			return false;
		}
	}
}
