<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Models\Page;
use App\Helpers\FilePathHelper;
use App\Services\OrderService;
use Illuminate\Support\Facades\Session;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService(config('pathao.base_url'), $app['config']['pathao.access_token']);
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
		
		// Share site settings, social links, and cart count with all views
		View::composer('frontEnd.layouts.app', function ($view) {
			$settings = SiteSetting::first(); // Fetch the first site setting
			// return $siteSettings;
			$footerLinks = Page::where('type', 1)->orderBy('order', 'asc')->get();
			$quickLinks = Page::where('type', 2)->orderBy('order', 'asc')->get();

			// Initialize socialLinks array
			$socialLinks = [];

			// Check if settings exist and if social_links is a string before decoding
			if ($settings && is_string($settings->social_links)) {
				$socialLinks = json_decode($settings->social_links, true) ?: []; // Decode safely
			} elseif ($settings && is_array($settings->social_links)) {
				// If social_links is already an array, use it directly
				$socialLinks = $settings->social_links;
			}

			// Get the icon mapping
			$iconMapping = $settings->getSocialIconMapping();

			// Fetch the cart session count
			$cartCount = count(Session::get('cart', []));

			// Pass settings, social links, icon mapping, and cart count to the view
			$view->with([
				'siteSettings' => $settings,
				'socialLinks' => $socialLinks,
				'iconMapping' => $iconMapping,
				'cartCount' => $cartCount, // Pass cart count for the badge
				'footerLinks' => $footerLinks, // Pass cart count for the badge
				'quickLinks' => $quickLinks, // Pass cart count for the badge
			]);
		});
	}

}
