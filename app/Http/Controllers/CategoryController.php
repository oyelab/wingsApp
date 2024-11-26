<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth')->except('mainCategory', 'wingsEdited', 'subCategory', 'frontShow', 'search');
		$this->middleware('role')->except('mainCategory', 'wingsEdited', 'subCategory', 'frontShow', 'search'); // Only allow role 1 users
    }

	public function mainCategory(Category $category)
	{
		return $category->products;
	}

	// In your CategoryController

	public function subCategory(Category $category, $subcategorySlug)
	{
		// Find the subcategory within the current category by slug
		$subcategory = $category->children()->where('slug', $subcategorySlug)->first();

		// Check if the subcategory exists, otherwise return a 404 error
		if (!$subcategory) {
			abort(404, 'Subcategory not found');
		}

		// Fetch products that are related to this subcategory through the pivot table
		$products = Product::whereHas('categories', function($query) use ($subcategory) {
			$query->where('category_product.subcategory_id', $subcategory->id);
		})->get();

		// If no products are found, you can handle it with a message or empty list
		if ($products->isEmpty()) {
			return response()->json(['message' => 'No products found in this subcategory.'], 404);
		}

		// return $products;


		return view('frontEnd.categories.test', compact('category', 'subcategory', 'products'));
	}

	public function wingsEdited(Request $request)
	{
		$CategoryId = 1; // ID of the category you want to load
		$pageTitle = Category::findOrFail($CategoryId)->title;

		// return $pageTitle;

		// Fetch the query parameters
		$mainCategoryId = $request->query('category') ?? null;
		$subCategoryId = $request->query('subCategory') ?? null;
	

		$sortOption = $request->query('sort'); // Capture the sort query parameter
		$searchTerm = $request->query('query'); // Capture the search query parameter

		// Initialize category and subcategory titles
		$categoryTitle = null;
		$subCategoryTitle = null;

		// Fetch the category and subcategory titles if available
		if ($mainCategoryId) {
			$category = Category::find($mainCategoryId);
			$categoryTitle = $category ? $category->title : null;
		}

		if ($subCategoryId) {
			$subCategory = Category::find($subCategoryId);
			$subCategoryTitle = $subCategory ? $subCategory->title : null;
		}

		// Base query for fetching products with their categories
		$productsQuery = Product::with('categories')
			->where('status', 1) // Ensure only active products are included
			->whereHas('categories', function ($query) use ($CategoryId) {
				$query->where('category_product.category_id', $CategoryId); // Filter by category_id = 1
			});

		// Apply filters based on main category and subcategory if provided
		if ($mainCategoryId) {
			$productsQuery->whereHas('categories', function ($query) use ($mainCategoryId) {
				$query->where('category_product.category_id', $mainCategoryId);
			});
		}

		if ($subCategoryId) {
			$productsQuery->whereHas('categories', function ($query) use ($subCategoryId) {
				$query->where('category_product.subcategory_id', $subCategoryId);
			});
		}

		// Count the products after applying filters
		$productCount = $productsQuery->count(); // Total product count after filters

		// Paginate the products, let's say 6 products per page
		$products = $productsQuery->paginate(6)->appends([
			'category' => $mainCategoryId,
			'subCategory' => $subCategoryId,
			'sort' => $sortOption,
			'query' => $searchTerm
		]);

		// Fetch all categories excluding a specific category ID if needed (e.g., 1)
		$categories = Category::with(['parents', 'children'])
			->where('id', $CategoryId) // Only fetch category ID = 1
			->get();


		return view('frontEnd.categories.index', compact(
			'categories',
			'products',
			'categoryTitle',
			'subCategoryTitle',
			'productCount',
			'mainCategoryId',
			'subCategoryId',
			'pageTitle',
		));
	}

	

	public function frontShow(Request $request)
	{
		// Fetch the query parameters
		$mainCategoryId = $request->query('category');
		$subCategoryId = $request->query('subCategory');
		$sortOption = $request->query('sort'); // Capture the sort query parameter
		$searchTerm = $request->query('query'); // Capture the search query parameter


		// Initialize category and subcategory titles
		$categoryTitle = null;
		$subCategoryTitle = null;
		$excludedCategoryId = 1; // ID of the category you want to exclude
		$pageTitle = "Collections";


		// Fetch the category and subcategory titles if available
		if ($mainCategoryId) {
			$category = Category::find($mainCategoryId);
			$categoryTitle = $category ? $category->title : null;
		}

		if ($subCategoryId) {
			$subCategory = Category::find($subCategoryId);
			$subCategoryTitle = $subCategory ? $subCategory->title : null;
		}

		// Base query for fetching products with their categories
		$productsQuery = Product::with('categories')->where('status', 1);
		// return $productsQuery;
		// Exclude products that belong to category ID 1
		// $productsQuery->whereDoesntHave('categories', function ($query) {
		// 	$query->where('category_product.category_id', 1);
		// });

		// return $productsQuery;

		// Apply filters based on main category and subcategory
		if ($mainCategoryId) {
			$productsQuery->whereHas('categories', function ($query) use ($mainCategoryId) {
				$query->where('category_product.category_id', $mainCategoryId);
			});
		}

		if ($subCategoryId) {
			$productsQuery->whereHas('categories', function ($query) use ($subCategoryId) {
				$query->where('category_product.subcategory_id', $subCategoryId);
			});
		}


		// Count the products after applying filters
		$productCount = $productsQuery->count(); // Total product count after filters

		// Paginate the products, let's say 6 products per page
		$products = $productsQuery->paginate(6)->appends([
			'category' => $mainCategoryId,
			'subCategory' => $subCategoryId,
			'sort' => $sortOption,
			'query' => $searchTerm
		]);

		// return $products;

		// Fetch all categories excluding a specific category ID if needed (e.g., 1)
		$categories = Category::with(['parents', 'children'])->get();


		return view('frontEnd.categories.index', compact(
			'categories',
			'products',
			'categoryTitle',
			'subCategoryTitle',
			'productCount',
			'mainCategoryId',
			'subCategoryId',
			'pageTitle',
		));
	}
	
	public function search(Request $request)
	{
		// return $request;
		// Fetch the query parameters
		$mainCategoryId = $request->query('category');
		$subCategoryId = $request->query('subCategory');
		$sortOption = $request->query('sort'); // Capture the sort query parameter
		$searchTerm = $request->query('query'); // Capture the search query parameter


		// Initialize category and subcategory titles
		$categoryTitle = null;
		$subCategoryTitle = null;
		$excludedCategoryId = 1; // ID of the category you want to exclude


		// Fetch the category and subcategory titles if available
		if ($mainCategoryId) {
			$category = Category::find($mainCategoryId);
			$categoryTitle = $category ? $category->title : null;
		}

		if ($subCategoryId) {
			$subCategory = Category::find($subCategoryId);
			$subCategoryTitle = $subCategory ? $subCategory->title : null;
		}

		// Base query for fetching products with their categories
		$productsQuery = Product::with('categories')->where('status', 1);
		// Exclude products that belong to category ID 1
		$productsQuery->whereDoesntHave('categories', function ($query) {
			$query->where('category_product.category_id', 1);
		});

		// Apply filters based on main category and subcategory
		if ($mainCategoryId) {
			$productsQuery->whereHas('categories', function ($query) use ($mainCategoryId) {
				$query->where('category_product.category_id', $mainCategoryId);
			});
		}

		if ($subCategoryId) {
			$productsQuery->whereHas('categories', function ($query) use ($subCategoryId) {
				$query->where('category_product.subcategory_id', $subCategoryId);
			});
		}


		// Count the products after applying filters
		$productCount = $productsQuery->count(); // Total product count after filters

		// Paginate the products, let's say 6 products per page
		$products = $productsQuery->paginate(6)->appends([
			'category' => $mainCategoryId,
			'subCategory' => $subCategoryId,
			'sort' => $sortOption,
			'query' => $searchTerm
		]);



		// Fetch all categories excluding a specific category ID if needed (e.g., 1)
		$categories = Category::with(['parents', 'children'])
			->where('id', '!=', $excludedCategoryId)
			->get();

		// Get the main category and subcategory ID from the request, or set them to null if not provided
		$selectedMainCategoryId = $request->query('category') ?? null;
		$selectedSubcategoryId = $request->query('subCategory') ?? null;


		return view('frontEnd.categories.index', compact(
			'categories',
			'products',
			'categoryTitle',
			'subCategoryTitle',
			'productCount',
			'mainCategoryId',
			'subCategoryId',
		));
	}



	public function getSubcategories($mainCategoryId)
	{
		// Get subcategories for the selected main category
		$mainCategory = Category::find($mainCategoryId);

		// Assuming a 'children' relationship exists on the Category model
		$subcategories = $mainCategory->children;

		return response()->json($subcategories);
	}

	 // Private function to get the slider path
	 private function getCategoryPath()
	 {
		return Storage::url('public/images/categories/');
	 }

    /**
     * Display a listing of the resource.
     */
	// public function index()
	// {
	// 	// Fetch all categories with their parent and child categories
	// 	$categories = Category::all();
	
	// 	// Loop through each category and load parent and child categories
	// 	foreach ($categories as $category) {
	// 		// Fetch the child categories (subcategories) for the current category
	// 		$category->child_categories = $category->children;  // All subcategories (children)
	
	// 		// Fetch the parent categories for the current category
	// 		$category->parent_categories = $category->parents;  // All parent categories
	// 	}

	
	// 	// Get category path or other required data
	// 	$categoryPath = $this->getCategoryPath(); // Call your private method if needed
	
	// 	// Return the data to the view
	// 	return view('backEnd.categories.index', [
	// 		'categories' => $categories,
	// 		'categoryPath' => $categoryPath,
	// 	]);
	// }
	
// 	public function index()
// {
//     // Fetch all categories with their children (if any) and parents
//     $categories = Category::with('parents', 'children')->get();

//     // Group categories by parent (or no parent)
//     $groupedCategories = $categories->groupBy(function ($category) {
//         return $category->parents->isEmpty() ? 'Main Category' : 'Sub Category';
//     });

// 	$categoryPath = $this->getCategoryPath(); // Call your private method if needed

//     // Pass the grouped categories to the view
//     return view('backEnd.categories.index', [
//         'groupedCategories' => $groupedCategories,
//     ]);
// }

	public function index()
	{
		// Get all main categories (those that have no parents) and load their children recursively
		$parentCategories = Category::whereDoesntHave('parents')->with('children')->get();

		return view('backEnd.categories.index', compact('parentCategories'));
	}


	public function create()
    {
		$categories = Category::with('parents')->get();
		// return $categories;
        return view('backEnd.categories.create', [
			'categories' => $categories,
		]);
    }

	public function store(Request $request)
	{
		// Define base validation rules
		$request->validate([
			'title' => 'required|string|max:255|unique:categories,title',
			'slug' => 'unique:categories,slug',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // Image validation
			'description' => 'required|string',
			'status' => 'required',
			'parent_ids' => 'nullable|array', // Ensure parent_ids is an array
			'parent_ids.*' => 'exists:categories,id', // Each parent_id should exist in categories table
		]);

		// Generate a slug from the title
		$slug = Str::slug($request->input('title'));

		// Get the uploaded file
		$file = $request->file('image');

		// Generate unique filename using the slug
		$filename = $slug . '.' . $file->getClientOriginalExtension();

		// Use Intervention Image to process the image and reduce quality to 85%
		$image = Image::make($file)
			->encode('webp', 85); // Reduce quality to 85% for WebP format

		// Save the processed image to the storage/app/public/categories directory
		$path = $image->storeAs('public/images/categories', $filename);

		// Create a new category
		$category = Category::create([
			'title' => $request->input('title'),
			'slug' => $slug,
			'description' => $request->input('description'),
			'image' => basename($path),
			'status' => $request->input('status'), // Set status based on request
		]);

		// If parent_ids are provided, attach them to the new category using the pivot table
		if ($request->has('parent_ids') && count($request->input('parent_ids')) > 0) {
			$category->parents()->attach($request->input('parent_ids'));
		}

		// Redirect back with a success message
		return redirect()->route('categories.index')->with('success', 'Category created successfully.');
	}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
	{
		// Fetch all categories to display as parent options
		$categories = Category::whereDoesntHave('parents')->get(); // Only fetch categories without parents (main categories)

		// Category image path
		$categoryPath = $this->getCategoryPath();

		// Return the view with the category data
		return view('backEnd.categories.edit', [
			'category' => $category,
			'categoryPath' => $categoryPath,
			'categories' => $categories, // Categories that can be selected as parents
		]);
	}


    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, Category $category)
	{
		// Validate the input data
		$request->validate([
			'title' => 'required|string|max:255|unique:categories,title,' . $category->id,
			'slug' => 'unique:categories,slug,' . $category->id,
			'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
			'description' => 'required|string',
			'status' => 'required',
			'parent_ids' => 'array', // Validate that parent_ids is an array if provided
			'parent_ids.*' => 'exists:categories,id', // Ensure each parent ID exists in the categories table
		]);

		// Generate a slug from the title
		$slug = Str::slug($request->input('title'));

		// Check if an image is uploaded
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$filename = $slug . '.webp'; // Save the file as WebP
			$path = storage_path('app/public/images/categories/' . $filename);

			// Use Intervention Image to compress and save the image
			$image = Image::make($file)
				->encode('webp', 85) // Reduce quality to 85%
				->save($path);

			// Update the category's image field
			$category->image = basename($path);
		}

		// Update the category's other fields
		$category->title = $request->input('title');
		$category->slug = $slug;
		$category->description = $request->input('description');
		$category->status = $request->input('status');
		$category->save();

		// Sync the parent categories in the pivot table
		if ($request->has('parent_ids')) {
			$category->parents()->sync($request->input('parent_ids'));
		} else {
			// If no parents are selected, detach any existing relationships
			$category->parents()->detach();
		}

		return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
	}



    /**
     * Remove the specified resource from storage.
     */
	public function destroy($id)
	{
		// Find the category by its ID
		$category = Category::findOrFail($id);
	
		// If this category has parents, just detach it from them
		if ($category->parents()->exists()) {
			$category->parents()->detach();
		} else {
			// Otherwise, delete the category itself (if it's a main category)
			$category->delete();
		}
	
		return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
	}
	

}
