<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Helpers\FilePathHelper;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
		// Share site settings and social links with all views
		View::composer('frontEnd.layouts.app', function ($view) {
			$settings = SiteSetting::first(); // Fetch the first site setting

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

			// Pass both settings and socialLinks to the view
			$view->with([
				'siteSettings' => $settings,
				'socialLinks' => $socialLinks,
				'iconMapping' => $iconMapping, // Pass the icon mapping
			]);
		});
	}

}
