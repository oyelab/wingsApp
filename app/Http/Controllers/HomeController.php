<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function show(Category $category, Product $product)
	{
		// Calculate the sale price if there is a discount (sale percentage > 0)
		$salePrice = $product->sale > 0 
			? $product->price - ($product->price * ($product->sale / 100)) 
			: $product->price;

		// Attach the sale price directly to the product instance
		$product->salePrice = $salePrice;

		// Eager load the sizes relation (only available sizes)
		$product->load('availableSizes');

		// return $product;

		// Return the view with the category and product
		return view('frontEnd.products.show', compact('category', 'product'));
	}



	public function index()
	{

		$sliders = Slider::where('status', 1)
					->orderBy('order', 'asc')
					->get();

		// Generate full image URLs with the correct folder structure
		foreach ($sliders as $slider) {
			$slider->url = Storage::url('public/images/sliders/' . $slider->image);
		}

		$categories = Category::with('products')->get();
		

		// Prepare product matrices for each category
		foreach ($categories as $category) {
			$category->productMatrix = $this->prepareProductMatrix($category->products);
		}

		// return $categories;

		return view('frontEnd.index', [
			'categories' => $categories,
			'sliders' => $sliders,
		]);
	}
	
	public function showCategory(Category $category)
	{
		// return $category;

		$sliders = Slider::where('status', 1)
					->orderBy('order', 'asc')
					->get();

		// Generate full image URLs with the correct folder structure
		foreach ($sliders as $slider) {
			$slider->url = Storage::url('public/images/sliders/' . $slider->image);
		}

		$categories = Category::with('products')->get();
		

		// Prepare product matrices for each category
		foreach ($categories as $category) {
			$category->productMatrix = $this->prepareProductMatrix($category->products);
		}

		// return $categories;

		return view('frontEnd.categories.index', [
			'categories' => $categories,
			'sliders' => $sliders,
		]);
	}

	// Method to prepare the product matrix
	private function prepareProductMatrix($products)
	{
		$productMatrix = [];

		foreach ($products as $product) {
			// Get the first image from the images array in the database
			$images = json_decode($product->images);
			$imagePath = !empty($images) ? 'images/products/' . $images[0] : null;

			// Prepare the product data
			$productData = [
				'id' => $product->id,
				'title' => $product->title,
				'slug' => $product->slug,
				'imagePath' => $imagePath,
				'price' => $product->price,
				'description' => $product->description,
			];

			// Include discount price only if sale exists
			if ($product->sale) {
				$productData['sale'] = $product->price * (1 - $product->sale / 100);
			}

			$productMatrix[] = $productData;
		}

		return $productMatrix;
	}

	
	
}
