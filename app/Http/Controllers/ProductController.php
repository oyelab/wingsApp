<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Quantity;
use App\Models\Section;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;




class ProductController extends Controller
{
	public function show(Category $category, $subcategorySlug, Product $product)
	{
		
		// Ensure the product belongs to the specified category
		if (!$product->categories->contains($category)) {
			abort(404); // If the product is not associated with this category, return 404
		}
	
		// Ensure the product's subcategory matches the provided slug
		$subcategory = $product->subcategory;
		if ($subcategory && $subcategory->slug !== $subcategorySlug) {
			abort(404); // If the subcategory slug does not match, return 404
		}
	
		// Increment product views
		$product->increment('views');
	
		// Get related products based on the current product
		$relatedProducts = Product::relatedProducts($product)->get();
	
		// Breadcrumb section
		$breadcrumbSection = Section::find($product->section_id); // Adjust as needed
		$mainCategory = $product->mainCategory; // Assuming there's a method or relation
	
		// Eager load the sizes relation (only available sizes) and categories
		$product->load('availableSizes', 'categories');

		$assets = Asset::all();

	
		// Determine the view based on the category slug
		$view = $category->slug === 'wings-edited' 
			? 'frontEnd.products.wings-edited' 
			: 'frontEnd.products.index';
	
		// Return the view with the necessary data
		return view($view, [
			'category' => $category, 
			'product' => $product, 
			'relatedProducts' => $relatedProducts, 
			'breadcrumbSection' => $breadcrumbSection, 
			'mainCategory' => $mainCategory,
			'section' => null,
			'collection' => $category,
			'assets' => $assets,
		]);
	}
	


	// public function show(Category $category, Product $product)
	// {
	// 	$product->increment('views');
		
	// 	$relatedProducts = Product::relatedProducts($product)->get();

	// 	// Eager load the sizes relation (only available sizes)
	// 	$product->load('availableSizes');
	// 	$product->load('categories');


	// 	// Return the view with the category and product
	// 	return view('frontEnd.products.index', compact('category', 'product', 'relatedProducts'));
	// }
	
	public function __construct()
    {
        $this->middleware('auth')->except('show' );;
		$this->middleware('role')->except('show');; // Only allow role 1 users

    }
	
    /**
     * Display a listing of the resource.
     */
	public function index()
	{
		// Retrieve products with their related quantities and categories, and paginate
		$products = Product::with('quantities', 'categories')->latest()->paginate(5);
		// return $products;
	
		foreach ($products as $product) {
			// Calculate the total quantity for each product
			$product->total_quantity = $product->quantities->sum('quantity');
	
			// Calculate the offer price and round it up
			if ($product->sale) {
				$offerPrice = $product->price * (1 - ($product->sale / 100)); // Calculate the offer price
				$product->offer_price = ceil($offerPrice); // Round it up to the nearest integer
			} else {
				$product->offer_price = null; // If there's no sale, set offer price to null
			}
	
			// Prepare the category display text
			$category_display = [];
	
			// Loop through the categories of the product to display category > subcategory
			foreach ($product->categories as $category) {
				// Get the parent category and subcategory from the pivot
				$parentCategory = Category::find($category->pivot->category_id); // Parent category
				$subCategory = Category::find($category->pivot->subcategory_id); // Subcategory
	
				// Format the display text as Category > Subcategory
				if ($parentCategory && $subCategory) {
					$category_display[] = $parentCategory->title . ' > ' . $subCategory->title;
				} else {
					$category_display[] = $category->title;
				}
			}
	
			// Save the category display to the product for later use in the view
			$product->category_display = implode(', ', $category_display); // Concatenate the display as a string
		}
	
		// Count total products
		$total = Product::count();
	
		// Count total published products
		$published = Product::where('status', 1)->count();
	
		// Count discounted products (assuming 'sale' field indicates discount)
		$discounted = Product::whereNotNull('sale')->count();
	
		// Count total quantities using the relationship
		$quantities = Product::with('quantities')->get()->sum(function ($product) {
			return $product->quantities->sum('quantity'); // Sum of quantities for each product
		});
	
		// Pack all data into a single variable
		$counts = [
			'total' => $total,
			'published' => $published,
			'discounted' => $discounted,
			'quantities' => $quantities,
		];
	
		// Pass the products with categories, quantities, and offer prices to the view
		return view('backEnd.products.index', [
			'products' => $products,
			'counts' => $counts,
		]);
	}
	

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$sizes = Size::all();
		$categories = Category::with('children')->whereDoesntHave('parents')->get(); // Get only parent categories
		
		// return $categories;
		$specifications = Specification::all();
		
        return view('backEnd.products.create', [
			'sizes' => $sizes, 
			'categories' => $categories, 
			'specifications' => $specifications]);
    }

    /**
     * Store a newly created resource in storage.
     */
	public function store(Request $request)
	{
		// Generate a slug from the title
		$slug = Str::slug($request->title);

		// Attach the category and subcategory to the product via the pivot table
		$categoryId = $request->category; // Main category ID
		$subcategoryId = $request->subcategory; // Subcategory ID

		// Validate the input
		$request->validate([
			'title' => [
				'required',
				'string',
				'max:255',
				function ($attribute, $value, $fail) use ($slug) {
					if (Product::where('title', $value)->exists()) {
						$fail('The title is already taken.');
					}
					if (Product::where('slug', $slug)->exists()) {
						$fail('A product with a similar title already exists (slug conflict).');
					}
				}
			],
			'price' => 'nullable|numeric|required_unless:category,1',
			'description' => 'required|string',
			'category' => 'required|exists:categories,id', // Ensure the category exists
			'subcategory' => 'required|exists:categories,id', // Ensure the subcategory exists
			'quantities.*' => 'nullable|numeric|min:0',
			'specifications' => 'nullable|array',
			'specifications.*' => 'exists:specifications,id',
			'images' => 'required|array',
			'images.*' => 'bail|required|image|mimes:jpeg,png,jpg,gif|max:20480',
			'meta_title' => 'nullable|string|max:255',
			'keywords' => 'nullable|array',
			'meta_desc' => 'nullable|string',
			'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);

		// Handle uploaded images with Intervention Image
		$images = [];
		if ($request->hasFile('images')) {
			foreach ($request->file('images') as $index => $image) {
				$imageName = $slug . '-' . ($index + 1) . '.webp'; // Save as WebP format
				$path = public_path('images/products/' . $imageName);

				// Compress and convert to WebP
				$processedImage = Image::make($image)
					->encode('webp', 85); // Reduce quality to 85%
				$processedImage->save($path);

				$images[] = $imageName;
			}
		}

		// Handle OG image
		$ogImageName = null;
		if ($request->hasFile('og_image')) {
			$ogImageName = $slug . '-og.webp'; // Save OG image as WebP
			$ogPath = public_path('images/products/' . $ogImageName);

			// Compress and convert to WebP
			$ogImage = Image::make($request->file('og_image'))
				->fit(1200, 630, function ($constraint) {
					$constraint->upsize(); // Prevent stretching smaller images
				})
				->encode('webp', 85); // Reduce quality to 85%
			$ogImage->save($ogPath);
		}

		// Process keywords and specifications
		$keywords = !empty($request->keywords) ? json_encode(array_filter($request->keywords)) : null;
		$specifications = !empty($request->specifications) ? json_encode(array_filter($request->specifications)) : null;

		// Store the product in the database
		$product = Product::create([
			'title' => $request->title,
			'slug' => $slug,
			'price' => $request->price,
			'sale' => $request->sale,
			'description' => $request->description,
			'specifications' => $specifications,
			'images' => json_encode($images),
			'meta_title' => $request->meta_title,
			'keywords' => $keywords,
			'meta_desc' => $request->meta_desc,
			'og_image' => $ogImageName,
		]);

		// Attach both category and subcategory to the product
		$product->categories()->attach($categoryId, ['subcategory_id' => $subcategoryId]);

		// Store quantities in the quantities table
		foreach ($request->quantities as $sizeId => $quantity) {
			if ($quantity > 0) {
				Quantity::create([
					'product_id' => $product->id,
					'size_id' => $sizeId,
					'quantity' => $quantity,
				]);
			}
		}

		return response()->json([
			'status' => 'success',
			'message' => 'Product created successfully.',
			'redirect_url' => route('products.index') // If you want to redirect
		]);
		
	}

	
	


    /**
     * Show the form for editing the specified resource.
     */
	public function edit(Product $product)
	{
		// Fetch only parent categories
		$categories = Category::whereDoesntHave('parents')->get(); // This will only fetch categories without parents

		// Get the main category and subcategory linked to the product using the pivot table
		$productCategory = $product->categories->first(); // Assuming the product is only linked to one main category

		// Retrieve subcategory ID from the pivot table
		$productSubcategoryId = $productCategory ? $productCategory->pivot->subcategory_id : null;

		// Other data fetching
		$sizes = Size::all();
		$quantities = $product->quantities->pluck('quantity', 'size_id')->toArray(); // Fetch quantities for each size
		$specifications = Specification::all();
		$selectedSpecifications = $product->specifications()->pluck('id')->toArray(); // Get selected specification IDs

		return view('backEnd.products.edit', [
			'product' => $product,
			'categories' => $categories,
			'sizes' => $sizes,
			'specifications' => $specifications,
			'quantities' => $quantities,
			'selectedSpecifications' => $selectedSpecifications,
			'productCategory' => $productCategory,
			'productSubcategoryId' => $productSubcategoryId, // Pass the subcategory ID to the view
		]);
	}


	
    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, Product $product)
	{
		$slug = Str::slug($request->title);

		// Validate the input
		$request->validate([
			'title' => [
				'required',
				'string',
				'max:255',
				function ($attribute, $value, $fail) use ($slug, $product) {
					// Check if the title already exists for another product
					$existingTitle = Product::where('title', $value)->where('id', '!=', $product->id)->first();

					// Check if the slug generated from title already exists for another product
					$existingSlug = Product::where('slug', $slug)->where('id', '!=', $product->id)->first();

					if ($existingTitle) {
						$fail('The title is already taken.');
					}

					if ($existingSlug) {
						$fail('A product with a similar title already exists (slug conflict).');
					}
				}
			],
			'price' => 'nullable|numeric|required_unless:category,1',
			'description' => 'required|string',
			'category' => 'required|exists:categories,id', // Ensure the main category is valid
			'subcategory' => 'required|exists:categories,id', // Validate against the pivot table id
			'quantities' => 'required|array',
			'quantities.*' => 'nullable|numeric|min:0',
			'specifications' => 'nullable|array',
			'specifications.*' => 'exists:specifications,id',
			'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
			'meta_title' => 'nullable|string|max:255',
			'keywords' => 'nullable|array',
			'meta_desc' => 'nullable|string',
			'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);

		// Process the title to create a unique slug for images
		$images = [];

		// Handle the newly uploaded images with Intervention Image
		if ($request->hasFile('images')) {
			foreach ($request->file('images') as $index => $image) {
				$imageName = $slug . '-' . ($index + 1) . '.webp'; // Save as WebP format
				$path = public_path('images/products/' . $imageName);

				// Compress and convert to WebP
				$processedImage = Image::make($image)
					->encode('webp', 85); // Reduce quality to 85%
				$processedImage->save($path);

				$images[] = $imageName;
			}
		}

		// Handle existing images
		$existingImages = $request->input('existing_images', []); // Get existing images from hidden input fields

		// Merge existing images with newly uploaded ones
		$allImages = array_merge($existingImages, $images);

		// Handle OG image (delete the old one if a new one is uploaded)
		$ogImageName = $product->og_image; // Keep the current OG image by default
		if ($request->hasFile('og_image')) {
			// Remove the old OG image if it exists
			if ($product->og_image && file_exists(public_path('images/products/' . $product->og_image))) {
				unlink(public_path('images/products/' . $product->og_image));
			}

			// Save the new OG image as WebP
			$ogImageName = $slug . '-og.webp';
			$ogPath = public_path('images/products/' . $ogImageName);

			// Compress and convert to WebP
			$ogImage = Image::make($request->file('og_image'))
				->fit(1200, 630, function ($constraint) {
					$constraint->upsize(); // Prevent stretching smaller images
				})
				->encode('webp', 85); // Reduce quality to 85%
			$ogImage->save($ogPath);
		}

		// Process keywords and specifications
		$keywords = (!empty($request->keywords) && is_array($request->keywords) && array_filter($request->keywords)) 
			? json_encode(array_filter($request->keywords)) 
			: null;

		$specifications = (!empty($request->specifications) && is_array($request->specifications) && array_filter($request->specifications)) 
			? json_encode(array_filter($request->specifications)) 
			: null; // Set to null if empty

		// Update the product in the database
		$product->update([
			'title' => $request->title,
			'slug' => $slug,
			'price' => $request->price,
			'description' => $request->description,
			'specifications' => $specifications,
			'images' => json_encode($allImages), // Store all images (existing and new) as JSON
			'meta_title' => $request->meta_title,
			'keywords' => $keywords,
			'meta_desc' => $request->meta_desc,
			'og_image' => $ogImageName, // Save the OG image file name
		]);

		// Sync categories and subcategories in the pivot table
		$product->categories()->sync([
			$request->category => ['subcategory_id' => $request->subcategory] // Sync with the selected category and subcategory
		]);

		// Update the quantities in the quantities table
		foreach ($request->quantities as $sizeId => $quantity) {
			Quantity::updateOrCreate(
				['product_id' => $product->id, 'size_id' => $sizeId],
				['quantity' => $quantity]
			);
		}

		return redirect()->route('products.index')->with('success', 'Product updated successfully.');
	}

	


	public function updateStatus(Request $request, Product $product)
	{
		// Validate the incoming request
		$request->validate([
			'status' => 'required|boolean',
		]);

		// Update the product's status
		$product->status = $request->status;
		$product->save();

		// Return a JSON response
		return response()->json([
			'message' => 'Product status updated successfully',
			'status' => $product->status ? 'Published' : 'Unpublished'
		]);
	}
	
	public function updateOffer(Request $request, Product $product)
	{
		if ($request->has('remove_offer')) {
			// Remove offer logic
			$product->sale = null;
		} else {
			// Update offer logic
			$validatedData = $request->validate([
				'sale' => 'nullable|numeric|min:0|max:100',
			]);
			$product->sale = $validatedData['sale'];
		}

		$product->save();

		return redirect()->route('products.index')->with('success', 'Offer updated successfully.');
	}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
	{
		// Delete related quantities first
		$product->quantities()->delete();

		// Decode the JSON to get the image file names
		$images = json_decode($product->images, true);

		if (!empty($images)) {
			foreach ($images as $image) {
				// Construct the full path
				$imagePath = 'images/products/' . $image;

				// Log the path for debugging
				Log::info("Attempting to delete image: " . $imagePath);

				// Check if the file exists and delete it
				if (Storage::disk('public')->exists($imagePath)) {
					Storage::disk('public')->delete($imagePath);
					Log::info("Deleted image: " . $imagePath);
				} else {
					Log::warning("Image not found: " . $imagePath);
				}
			}
		}

		// Delete the product
		$product->delete();

		// Redirect back to the products list with a success message
		return redirect()->back()->with('success', 'Product and its related quantities and images deleted successfully.');
	}
}
