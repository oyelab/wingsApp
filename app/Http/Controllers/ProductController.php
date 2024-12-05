<?php

namespace App\Http\Controllers;

use App\Models\Test;
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
use Illuminate\Support\Facades\Validator;






class ProductController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth')->except('show' );;
		$this->middleware('role')->except('show');; // Only allow role 1 users

    }
	

    /**
     * Store a newly created resource in storage.
     */
	public function store(Request $request)
	{
		$slug = Str::slug($request->title);

		// Attach the category and subcategory to the product via the pivot table
		$categoryId = $request->category; // Main category ID
		$subcategoryId = $request->subcategory; // Subcategory ID

		// Manually validate the request
		$validator = Validator::make($request->all(), [
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
			'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp',
			'meta_title' => 'nullable|string|max:255',
			'keywords' => 'nullable|array',
			'meta_desc' => 'nullable|string',
			'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
		]);

		// Check for validation errors
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => 'Validation errors occurred.',
				'errors' => $validator->errors()->toArray(),
			], 422);
		}

		// Process keywords and specifications
		$keywords = !empty($request->keywords) ? json_encode(array_filter($request->keywords)) : null;
		$specifications = !empty($request->specifications) ? json_encode(array_filter($request->specifications)) : null;


		// Proceed with creating the Product
		$collection = Product::create([
			'title' => $request->title,
			'slug' => $slug,
			'price' => $request->price,
			'sale' => $request->sale,
			'description' => $request->description,
			'specifications' => $specifications,
			'meta_title' => $request->meta_title,
			'keywords' => $keywords,
			'meta_desc' => $request->meta_desc,
		]);

		$collectionId = $collection->id;
		$storagePath = "public/collections/{$collectionId}";

		$directory = storage_path("app/{$storagePath}");
		if (!file_exists($directory)) {
			mkdir($directory, 0775, true);
		}

		// Store images
		$imageFilenames = [];
		foreach ($request->file('images') as $image) {
			$originalFilename = $image->getClientOriginalName();
			$image->storeAs($storagePath, $originalFilename);
			$imageFilenames[] = $originalFilename;
		}

		$collection->images = $imageFilenames;

		// Handle OG Image with a custom timestamp-based name
		if ($request->hasFile('og_image')) {
			$ogImage = $request->file('og_image');

			// Generate a unique filename with a timestamp and original extension
			$timestamp = now()->format('YmdHisu'); // Format: YYYYMMDD_HHMMSS_microseconds
			$extension = $ogImage->getClientOriginalExtension(); // Get original file extension
			$ogImageFilename = "{$timestamp}.{$extension}";

			// Store the file with the generated filename
			$ogImage->storeAs($storagePath, $ogImageFilename);

			// Save filename to the `og_image` field
			$collection->og_image = $ogImageFilename;
		}

		$collection->save();

		// Attach category and subcategory
		$collection->categories()->attach($categoryId, ['subcategory_id' => $subcategoryId]);

		// Store quantities
		foreach ($request->quantities as $sizeId => $quantity) {
			Quantity::create([
				'product_id' => $collection->id,
				'size_id' => $sizeId,
				'quantity' => $quantity,
			]);
		}

		return response()->json([
			'success' => true,
			'message' => 'Product created successfully!',
			'redirect_url' => route('products.index'), // Redirect to the product page
		]);
	}


	public function update(Request $request, Product $product)
	{
		// Validate the request
		$validator = Validator::make($request->all(), [
			'title' => "required|string|max:255|unique:products,title,{$product->id}",
			'price' => 'nullable|numeric|required_unless:category,1',
			'description' => 'required|string',
			'category' => 'required|exists:categories,id',
			'subcategory' => 'required|exists:categories,id',
			'quantities.*' => 'nullable|numeric|min:0',
			'specifications' => 'nullable|array',
			'specifications.*' => 'exists:specifications,id',
			'images_order' => 'array', // Order of images (only needed for updates)
			'images_order.*' => 'string', // Ensure each image order entry is a string or null
			'images' => 'array', // Images required only if images_order is not present
			'images.*' => 'image|mimes:jpg,jpeg,png,gif,webp',
			'meta_title' => 'nullable|string|max:255',
			'keywords' => 'nullable|array',
			'meta_desc' => 'nullable|string',
			'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
		]);

		$slug = Str::slug($request->title);

		// Check if the slug is unique (excluding the current product)
		if (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
			$validator->after(function ($validator) {
				$validator->errors()->add('title', 'The title generates a duplicate slug. Please choose a different title.');
			});
		}
		// Handle validation errors
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => 'Validation errors occurred.',
				'errors' => $validator->errors()->toArray(),
			], 422);
		}

		// Define storage path
		$storagePath = "public/collections/{$product->id}";
		$directory = storage_path("app/{$storagePath}");

		// Ensure the directory exists
		if (!file_exists($directory)) {
			mkdir($directory, 0775, true);
		}

		// If images_order is provided (for reordering existing images)
		if ($request->has('images_order')) {
			$imagesOrder = $request->input('images_order', []);
			$existingImages = $product->images ?? [];

			// Identify any images to delete (those not in the new order)
			$imagesToDelete = array_diff($existingImages, $imagesOrder);
			foreach ($imagesToDelete as $image) {
				$imagePath = storage_path("app/{$storagePath}/{$image}");
				if (file_exists($imagePath)) {
					unlink($imagePath);
				}
			}

			// Ensure the images_order maintains uniqueness and proper order
			$product->images = array_unique($imagesOrder); // Ensure unique entries and preserve order

			// $product->save();
		}

		// Check if new images are uploaded
		if ($request->hasFile('images')) {
			$newImages = $request->file('images');
			$uploadedImages = [];

			// Ensure the new images are uploaded correctly in order
			foreach ($newImages as $image) {
				$uniqueName = $image->getClientOriginalName();
				$image->storeAs($storagePath, $uniqueName);
				$uploadedImages[] = $uniqueName;
			}
		}

		// Handle OG Image with a custom timestamp-based name
		if ($request->hasFile('og_image')) {
			$ogImage = $request->file('og_image');

			// Generate a unique filename with a timestamp and original extension
			$timestamp = now()->format('YmdHisu'); // Format: YYYYMMDD_HHMMSS_microseconds
			$extension = $ogImage->getClientOriginalExtension(); // Get original file extension
			$ogImageFilename = "{$timestamp}.{$extension}";

			// Store the file with the generated filename
			$ogImage->storeAs($storagePath, $ogImageFilename);

			// Remove the old OG image from storage (if exists)
			$oldOgImage = $product->og_image; // Assuming 'og_image' contains the current filename
			if ($oldOgImage && Storage::exists("{$storagePath}/{$oldOgImage}")) {
				Storage::delete("{$storagePath}/{$oldOgImage}"); // Remove the old image from storage
			}

			// Update the OG image in the product
			$product->og_image = $ogImageFilename; // Set the new OG image filename
			$product->save(); // Save the changes to the product
		}

		// For the update action
		$keywords = !empty($request->keywords) 
		? array_map('trim', explode(',', implode(',', $request->keywords))) 
		: null;

		// Process keywords and specifications
		$keywords = !empty($request->keywords) ? json_encode(array_filter($keywords)) : null;
		$specifications = !empty($request->specifications) ? json_encode(array_filter($request->specifications)) : null;


		// Update the product data
		$product->update([
			'images' => $request->images_order,
			'title' => $request->title,
			'slug' => $slug,
			'price' => $request->price,
			'sale' => $request->sale,
			'description' => $request->description,
			'specifications' => $specifications,
			'meta_title' => $request->meta_title,
			'keywords' => $keywords,
			'meta_desc' => $request->meta_desc,
		]);

		// Attach category and subcategory
		$product->categories()->sync([$request->category => ['subcategory_id' => $request->subcategory]]);

		// Update the quantities in the quantities table
		foreach ($request->quantities as $sizeId => $quantity) {
			Quantity::updateOrCreate(
				['product_id' => $product->id, 'size_id' => $sizeId],
				['quantity' => $quantity]
			);
		}
		// Return success response
		return response()->json([
			'success' => true,
			'message' => 'Product updated successfully',
			'redirect_url' => route('products.index'),
		]);
	}
	 
	// Helper method to delete a directory and its contents
	private function deleteDirectory($dirPath)
	{
		if (!file_exists($dirPath)) return;
	
		// Get all files and subdirectories
		$files = array_diff(scandir($dirPath), array('.', '..'));
	
		foreach ($files as $file) {
			$filePath = $dirPath . '/' . $file;
			if (is_dir($filePath)) {
				$this->deleteDirectory($filePath); // Recurse into subdirectories
			} else {
				unlink($filePath); // Delete file
			}
		}
	
		rmdir($dirPath); // Delete the directory itself
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

		// Assuming images are stored in the 'public/collections/{productId}' directory
		$storagePath = "collections/{$product->id}";  // Path relative to 'public'

		$images = $product->images; // Assuming images are stored as an array of filenames
		
		if (!empty($images)) {
			foreach ($images as $image) {
				$imagePath = "{$storagePath}/{$image}"; // Image path relative to 'public'
				if (Storage::disk('public')->exists($imagePath)) {
					Storage::disk('public')->delete($imagePath); // Delete the image
				}
			}
		}

		// Delete the product
		$product->delete();

		// Now remove the product-specific folder if it is empty
		if (Storage::disk('public')->exists($storagePath) && count(Storage::disk('public')->files($storagePath)) == 0) {
			Storage::disk('public')->deleteDirectory($storagePath); // Delete the folder only if it's empty
		}

		// Return success response
		return response()->json(['success' => true]);
	}
	

	/**
     * Display a listing of the resource.
     */
	public function index(Request $request)
	{
		$search = $request->input('search'); // Get the search term from the request

		// Retrieve products with their related quantities and categories, and paginate
		$products = Product::with('quantities', 'categories')
		->when($search, function ($query, $search) {
			return $query->where('title', 'like', "%{$search}%"); // Search in multiple columns
		})
		->latest()
		->paginate(10); // Adjust pagination as needed (e.g., 10 per page)
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
	
	public function show(Category $category, $subcategorySlug, Product $product)
	{
		// return $product;
		
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

		$wingsPower = Asset::where('type', 'wings_power_banner')->firstOrFail();
		// return $asset;

	
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
			'wingsPower' => $wingsPower,
		]);
	}
	

	public function edit(Product $product)
	{
		// return $product;
		$existingImages = $product->allImagePaths; // Get the existing images
		// return $existingImages;

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
			// 'existingImagesData' => $existingImages,
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

}
