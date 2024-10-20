<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {// Retrieve products with their related quantities and paginate
		$categories = Category::latest()->paginate(10);

		// Pass the products with categories, quantities, and offer prices to the view
		return view('backEnd.categories.index', [
			'categories' => $categories,
		]);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

		

		// Pass the products with categories, quantities, and offer prices to the view
		return view('backEnd.categories.create', [
			'categories' => $categories,
		]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

		$slug = Str::slug($request->name);

		$request->validate([
			'name' => 'required|string|max:255',
			'slug' => 'unique:categories,slug',
			'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Cover image validation
			'description' => 'required|string',
			'parent_id' => 'nullable|exists:categories,id', // Parent ID should exist in the categories table
		]);

		 // Handle the cover image
		 if ($request->hasFile('cover')) {
			$file = $request->file('cover');
	
			// Create the directory if it doesn't exist
			$destinationPath = public_path('images/categories');
			if (!File::exists($destinationPath)) {
				File::makeDirectory($destinationPath, 0755, true);
			}
	
			// Image name based on slug (no '-cover' suffix)
			$imageName = $slug . '.' . $file->getClientOriginalExtension();
			
			// Move the uploaded image to the specified path
			$file->move($destinationPath, $imageName);
		}	
	
		// Create the category
		$category = Category::create([
			'name' => $request->input('name'),
			'slug' => $slug,
			'cover' => $imageName, // Store only the image name
			'description' => $request->input('description'),
			'parent_id' => $request->input('parent_id'), // Parent category if applicable
		]);
	
	
		return redirect()->route('categories.index')->with('success', 'Category created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

		// $category = Category::find($category);
		$products = $category->products;

		// return $products;
        // $categoryProduct = categories()->products;

		return $products;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
		$categories = Category::all();

        return view('backEnd.categories.edit', [
			'category' => $category,
			'categories' => $categories,
		]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
	{
		// Generate the slug
		$slug = Str::slug($request->name);

		// Validate the request
		$request->validate([
			'name' => 'required|string|max:255',
			'slug' => 'unique:categories,slug,' . $category->id, // Exclude the current category from the unique check
			'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Cover image validation
			'description' => 'required|string',
			'parent_id' => 'nullable|exists:categories,id', // Parent ID should exist in the categories table
		]);

		// Handle the cover image if it was uploaded
		$imageName = $category->cover; // Default to existing image name

		if ($request->hasFile('cover')) {
			$file = $request->file('cover');

			// Create the directory if it doesn't exist
			$destinationPath = public_path('images/categories');
			if (!File::exists($destinationPath)) {
				File::makeDirectory($destinationPath, 0755, true);
			}

			// Image name based on slug
			$imageName = $slug . '.' . $file->getClientOriginalExtension();

			// Move the uploaded image to the specified path
			$file->move($destinationPath, $imageName);
		}

		// Update the category
		$category->update([
			'name' => $request->input('name'),
			'slug' => $slug,
			'cover' => $imageName, // Store only the image name
			'description' => $request->input('description'),
			'parent_id' => $request->input('parent_id'), // Parent category if applicable
		]);

		return redirect()->route('categories.index')->with('success', 'Category updated successfully');
	}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Handle the cover image deletion (if applicable)
		if ($category->cover) {
			$imagePath = public_path('images/categories/' . $category->cover);
			
			if (File::exists($imagePath)) {
				File::delete($imagePath);
			}
		}

		$category->delete();
		
		// Redirect back to the products list with a success message
		return redirect()->back()->with('message', 'The category has been deleted.');
    }
}
