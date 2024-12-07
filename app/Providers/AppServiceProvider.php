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
		Paginator::useBootstrapFive();

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


}
