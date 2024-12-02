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
		$collection->save();

		// Attach category and subcategory
		$collection->categories()->attach($categoryId, ['subcategory_id' => $subcategoryId]);

		// Store quantities
		foreach ($request->quantities as $sizeId => $quantity) {
			if ($quantity > 0) {
				Quantity::create([
					'product_id' => $collection->id,
					'size_id' => $sizeId,
					'quantity' => $quantity,
				]);
			}
		}

		return response()->json([
			'success' => true,
			'message' => 'Product created successfully!',
			'redirect_url' => route('products.show', $collection->id), // Redirect to the product page
		]);
	}


	
    /**
     * Update the specified resource in storage.
     */

	 public function update(Request $request, $product)
	{
		// Manually validate the request
		$validator = Validator::make($request->all(), [

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
		]);

		// Check for validation errors
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => 'Validation errors occurred.',
				'errors' => $validator->errors()->toArray(),
			], 422);
		}

		$product = Product::findOrFail($product);  // Find the product to update
		// return $product;

		// Process the existing images
		$existingImages = $product->images; // Assuming you have a relationship or field `images` for existing images

		// Prepare an array for the new images that will be uploaded
		$updatedImages = [];

		// If new images were uploaded
		if ($request->hasFile('images')) {
			// Loop over the uploaded images and rename them sequentially
			foreach ($request->file('images') as $index => $image) {
				$filename = str_pad($index + 1, 2, '0', STR_PAD_LEFT) . '.' . $image->getClientOriginalExtension();
				$path = $image->storeAs('products', $filename, 'public');
				
				// Store the new image information
				$updatedImages[] = $path;
			}
		}

		// Delete the old images if necessary
		if (!empty($updatedImages)) {
			foreach ($existingImages as $existingImage) {
				// Remove the old images from storage (if they exist)
				if (Storage::exists($existingImage)) {
					Storage::delete($existingImage);
				}
			}
		}

		// Update product with new images
		$product->images = $updatedImages;  // You may need to update this part based on how your images are stored in the database

		// Save the product
		$product->save();

		// Return a success response
		return response()->json([
			'success' => true,
			'message' => 'Product updated successfully with new images!',
			'redirect_url' => route('products.show', $product->id), // Redirect to the product page
		]);
	}

	
	//  public function update(Request $request, Product $product)
	//  {
	// 	 // Generate slug from the new title
	// 	 $slug = Str::slug($request->title);
	 
	// 	 // Validate the request
	// 	 $validator = Validator::make($request->all(), [
	// 		 'title' => 'required|string|max:255',
	// 		 'price' => 'nullable|numeric|required_unless:category,1',
	// 		 'description' => 'required|string',
	// 		 'category' => 'required|exists:categories,id',
	// 		 'subcategory' => 'required|exists:categories,id',
	// 		 'images' => 'required|array',  // Ensure images are present in request
	// 		 'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp', // Validate the image type
	// 		 'meta_title' => 'nullable|string|max:255',
	// 		 'keywords' => 'nullable|array',
	// 		 'meta_desc' => 'nullable|string',
	// 	 ]);
	 
	// 	 // Check for validation errors
	// 	 if ($validator->fails()) {
	// 		 return response()->json([
	// 			 'success' => false,
	// 			 'message' => 'Validation errors occurred.',
	// 			 'errors' => $validator->errors()->toArray(),
	// 		 ], 422);
	// 	 }
	 
	// 	 // Update the product data
	// 	 $product->update([
	// 		 'title' => $request->title,
	// 		 'slug' => $slug,
	// 		 'price' => $request->price,
	// 		 'sale' => $request->sale,
	// 		 'description' => $request->description,
	// 		 'specifications' => json_encode($request->specifications),
	// 		 'meta_title' => $request->meta_title,
	// 		 'keywords' => !empty($request->keywords) ? json_encode(array_filter($request->keywords)) : null,
	// 		 'meta_desc' => $request->meta_desc,
	// 	 ]);
	 
	// 	 $productId = $product->id;
	// 	 $storagePath = "public/collections/{$productId}";
	// 	 $directory = storage_path("app/{$storagePath}");
	 
	// 	 // Delete the entire directory to remove old images (if it exists)
	// 	 if (file_exists($directory)) {
	// 		 $this->deleteDirectory($directory);
	// 	 }
	 
	// 	 // Recreate the directory to store new images
	// 	 mkdir($directory, 0775, true);
	 
	// 	 // Store new images (even the reordered ones will be treated as new)
	// 	 $newImageFilenames = [];
	// 	 if ($request->hasFile('images')) {
	// 		 foreach ($request->file('images') as $image) {
	// 			 $newFilename = $image->storeAs($storagePath, $image->getClientOriginalName());
	// 			 $newImageFilenames[] = basename($newFilename);  // Store the new image filenames
	// 		 }
	// 	 }
	 
	// 	 // Update the product with the new image filenames
	// 	 if (count($newImageFilenames) > 0) {
	// 		 $product->images = $newImageFilenames;
	// 		 $product->save();
	// 	 }
	 
	// 	 // Attach category and subcategory
	// 	 $product->categories()->sync([$request->category => ['subcategory_id' => $request->subcategory]]);
	 
	// 	 return response()->json([
	// 		 'success' => true,
	// 		 'message' => 'Product updated successfully!',
	// 		 'redirect_url' => route('product.index'),
	// 	 ]);
	//  }
		  
	 
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
	
	public function show(Product $product)
	{
		return $product;
		
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
	

	public function edit(Product $product)
	{
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
