<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Section;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;

use App\Services\HomePageService;



use Illuminate\Http\Request;

class HomeController extends Controller
{
	protected $homePageService;

    public function __construct(HomePageService $homePageService)
    {
        $this->homePageService = $homePageService;
    }

	public function index()
    {
		$wingsEdited = Category::with(['products' => function ($query) {
			$query->where('status', 1) // Only include active products
			      ->take(4); // Limit to 4 products
		}])
		->where('order', 3) // Only include categories with type 0
		->where('status', 1) // Only include active categories
		->first();


		$sliders = Slider::where('status', 1)->orderBy('order', 'asc')->get();
        $data = $this->homePageService->getHomePageData();
        $titles = [
            'latest' => 'Latest Arrivals, Ready to Fly!',
            'topPicks' => 'Top Picks, Always in Style!',
            'mostViewed' => 'No Message!',
            'hotDeals' => 'Hot Deals, Just for You!',
            'trending' => 'On Trend, On Point!',
        ];

        return view('frontEnd.index', compact('data', 'titles', 'sliders', 'wingsEdited', ));
    }

	public function show(Category $category, Product $product)
	{
		// Calculate the sale price only if there is a discount
		$salePrice = $product->offerPrice;

		// Attach the sale price and images directly to the product instance
		$product->salePrice = $salePrice;

		// Eager load the sizes relation (only available sizes)
		$product->load('availableSizes');
		$product->load('categories');

		// Return the view with the category and product
		return view('frontEnd.products.show', compact('category', 'product'));
	}
}
