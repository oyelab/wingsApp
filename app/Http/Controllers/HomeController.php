<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Section;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Showcase;
use App\Models\Size;
use App\Models\Asset;
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
		->where('slug', 'wings-edited')
		->first();

		$showcases = Showcase::with('details')->orderBy('order')->limit(5)->get();
		
		$manufactureLogo = Asset::where('type', 'manufacturer')->first();
		$paymentBanner = Asset::where('type', 'payment')->first();
		$partnerLogos = Asset::where('type', 'partner')->get();

		// return $wingsEdited;


		$sliders = Slider::where('status', 1)->orderBy('order', 'asc')->get();
       
		$data = $this->homePageService->getHomePageData();

		// Fetch titles dynamically from the database
		$titlesData = Section::all(); // Assuming you have a `Title` model

		// Convert titles to an associative array
		$titles = $titlesData->pluck('title', 'type')->toArray();
        

        return view('frontEnd.index', compact('data', 'titles', 'sliders', 'wingsEdited', 'showcases', 'manufactureLogo', 'partnerLogos', 'paymentBanner', ));
    }

	// public function show(Category $category, $subcategorySlug, Product $product)
	// {
	// 	// Increment product views
	// 	$product->increment('views');
		
	// 	// Get the subcategory based on the slug
		
	// 	// Get related products based on the current product
	// 	$relatedProducts = Product::relatedProducts($product)->get();

	// 	$breadcrumbSection = Section::find($product->section_id); // Adjust as needed
	// 	$mainCategory = $product->mainCategory; // Assuming there's a method or relation

		
	// 	// Eager load the sizes relation (only available sizes) and categories
	// 	$product->load('availableSizes');
	// 	$product->load('categories');
		
	// 	// Return the view with the category, subcategory, and product
	// 	return view('frontEnd.products.index', compact('category',  'product', 'relatedProducts', 'breadcrumbSection', 'mainCategory',));
	// }
	
}
