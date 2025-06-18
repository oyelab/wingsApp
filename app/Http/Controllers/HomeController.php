<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\Section;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Showcase;
use App\Models\Size;
use App\Models\Asset;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ProductRepository;

use App\Services\HomePageService;



use Illuminate\Http\Request;

class HomeController extends Controller
{
	protected $homePageService;
	protected $productRepo;

    public function __construct(HomePageService $homePageService, ProductRepository $productRepo)
    {
        $this->homePageService = $homePageService;
		$this->productRepo = $productRepo;
    }

	public function index()
    {


		$wingsEdited = Category::with(['products' => function ($query) {
			$query->where('status', 1) // Only include active products
				  ->orderBy('created_at', 'desc') // Order by created_at descending
				  ->take(4); // Limit to 4 products
		}])
		->where('slug', 'wings-edited')
		->first();		

		$behindWings = Page::where('type', 3)->orderBy('order', 'asc')->get();
		// return $behindWings;

		$customOrder = Page::where('slug', 'custom-order')->first();
		// return $customOrder;

		// Get reviews ordered by the rating column
		$siteReviews = Review::with('user', 'products')
			->where('status', true)
			->orderBy('rating', 'desc')
			->get();

		$showcases = Showcase::where('status', 1)
			->whereNotNull('order')  // Ensure 'order' is not null
			->orderBy('order', 'asc') // Order by the 'order' field
			->limit(6)
			->get();


		// return $showcases;
		
		$manufactureLogo = Asset::where('type', 1)->first();
		$partnerLogos = Asset::where('type', 2)->get();
		$paymentBanner = Asset::where('type', 3)->first();


		// return $wingsEdited;


		$sliders = Slider::where('status', 1)->orderBy('order', 'asc')->get();
       
		$data = $this->homePageService->getHomePageData();
		$latestProducts = $this->productRepo->getLatestProducts();
		// return $data;

		// Fetch titles dynamically from the database
		$titlesData = Section::all(); // Assuming you have a `Title` model
		$bulksData = $titlesData->firstWhere('type', 'bulks');

		// Convert titles to an associative array
		$titles = $titlesData->pluck('title', 'type')->toArray();

		// return $titles;
        

        return view('frontEnd.index', compact('data', 'latestProducts', 'titles', 'bulksData', 'sliders', 'wingsEdited', 'showcases', 'manufactureLogo', 'partnerLogos', 'paymentBanner', 'siteReviews', 'behindWings', 'customOrder'));
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
	// 	return view('frontEnd.products.show', compact('category',  'product', 'relatedProducts', 'breadcrumbSection', 'mainCategory',));
	// }
	
}
