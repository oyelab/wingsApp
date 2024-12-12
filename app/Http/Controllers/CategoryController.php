<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use App\Services\FileHandlerService;



class CategoryController extends Controller
{
	protected $fileHandler;

	public function __construct(FileHandlerService $fileHandler)
    {
		$this->fileHandler = $fileHandler;

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
		$products = $productsQuery
		->orderBy('created_at', 'desc') // Ensure the latest products are displayed first
		->paginate(9) // Paginate the results with 6 products per page
		->appends([
			'category' => $mainCategoryId,
			'subCategory' => $subCategoryId,
			'sort' => $sortOption,
			'query' => $searchTerm
		]);
	

		// Fetch all categories excluding a specific category ID if needed (e.g., 1)
		$categories = Category::with(['parents', 'children'])
			->where('id', $CategoryId) // Only fetch category ID = 1
			->get();

		$section = null;
		$collection = null;

		return view('frontEnd.categories.index', compact(
			'categories',
			'products',
			'categoryTitle',
			'subCategoryTitle',
			'productCount',
			'mainCategoryId',
			'subCategoryId',
			'pageTitle',
			'section',
			'collection',
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
		$products = $productsQuery
		->orderBy('created_at', 'desc') // Ensure the latest products are displayed first
		->paginate(9) // Paginate the results with 6 products per page
		->appends([
			'category' => $mainCategoryId,
			'subCategory' => $subCategoryId,
			'sort' => $sortOption,
			'query' => $searchTerm
		]);
	

		// return $products;

		// Fetch all categories excluding a specific category ID if needed (e.g., 1)
		$categories = Category::with(['parents', 'children'])->get();

		$section = null;
		$collection = null;

		return view('frontEnd.categories.index', compact(
			'categories',
			'products',
			'categoryTitle',
			'subCategoryTitle',
			'productCount',
			'mainCategoryId',
			'subCategoryId',
			'pageTitle',
			'section',
			'collection',
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
		return Storage::url('public/categories/');
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
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096', // Image validation
			'description' => 'required|string',
			'status' => 'required',
			'parent_ids' => 'nullable|array', // Ensure parent_ids is an array
			'parent_ids.*' => 'exists:categories,id', // Each parent_id should exist in categories table
		]);

		// Generate a slug from the title
		$slug = Str::slug($request->input('title'));

		// Create a new category
		$category = Category::create([
			'title' => $request->input('title'),
			'slug' => $slug,
			'description' => $request->input('description'),
			'status' => $request->input('status'), // Set status based on request
		]);

		// Check if a file is uploaded
		if ($request->hasFile('image')) {
			$file = $request->file('image');

			// Store the file and get only the filename
			$filename = $this->fileHandler->storeFile($file, 'categories');  // 'Asset' is the directory based on your model
			
			// Save the filename in the database
			$category->image = $filename;  // Assuming 'file_name' is a column in your 'assets' table

			$category->save();
		}

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
		// return $category;
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
			'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
			'description' => 'required|string',
			'status' => 'required',
			'parent_ids' => 'array', // Validate that parent_ids is an array if provided
			'parent_ids.*' => 'exists:categories,id', // Ensure each parent ID exists in the categories table
		]);

		// Generate a slug from the title if the title has changed
		$slug = $category->title !== $request->input('title') 
			? Str::slug($request->input('title')) 
			: $category->slug;

		// Check if a new file is uploaded
		if ($request->hasFile('image')) {
			$file = $request->file('image');

			// Delete the old file if it exists
			if ($category->image) {
				$this->fileHandler->deleteFile('categories/' . $category->image); // 'assets' directory is used
			}

			// Store the new file and update the filename in the database
			$filename = $this->fileHandler->storeFile($file, 'categories');
			$category->image = $filename; // Assuming 'file' is the column for filename

			$category->save();
		}

		// Update the category's other fields
		$category->title = $request->input('title');
		$category->slug = $slug;
		$category->description = $request->input('description');
		$category->status = $request->input('status');
		$category->save();

		// Sync the parent categories
		if ($request->has('parent_ids')) {
			if (in_array($category->id, $request->input('parent_ids'))) {
				return redirect()->back()->withErrors(['parent_ids' => 'A category cannot be its own parent.']);
			}
			$category->parents()->sync($request->input('parent_ids'));
		} else {
			// If no parents are selected, detach existing relationships
			$category->parents()->detach();
		}

		return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
	}



    /**
     * Remove the specified resource from storage.
     */
	public function destroy(Category $category)
	{
		// Directly use the file path from the asset
		if ($category->image) {
			// Use the FileHandlerService to delete the file
			$this->fileHandler->deleteFile('categories/' . $category->image);
		}
	
		// Delete the asset from the database
		$category->delete();
	
		// Redirect with a success message
		return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
	}

}
