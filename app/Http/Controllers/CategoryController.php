<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Section;

class CategoryController extends Controller
{

	 // Private function to get the slider path
	 private function getCategoryPath()
	 {
		return Storage::url('public/images/categories/');
	 }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		$categories = Category::all();
        $categoryPath = $this->getCategoryPath(); // Call the private function

		// return $sliderPath;

        return view('backEnd.categories.index', [
            'categories' => $categories,
            'categoryPath' => $categoryPath,
        ]);
    }

	
    
	public function create()
    {
		$sections = Section::all();
		$categories = Category::all();
        return view('backEnd.categories.create', [
			'categories' => $categories,
			'sections' => $sections,
		]);
    }

	public function store(Request $request)
	{
		// Define base validation rules
		$rules = [
			'title' => 'required|string|max:255|unique:categories,title',
			'slug' => 'unique:categories,slug',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // Image validation
			'description' => 'required|string',
			'parent_id' => 'nullable|exists:categories,id', // Parent ID should exist in the categories table
		];

		// Add order validation rule based on status
		if (in_array($request->input('status'), [1, 2])) {
			$rules['order'] = 'required|integer'; // Order is required for Product and Item
		} else {
			$rules['order'] = 'nullable|integer'; // Order is nullable for Unpublished
		}

		// Validate the request with the defined rules
		$request->validate($rules);

		// Custom validation to ensure 'order' is not set when status is 0
		if ($request->input('status') == 0 && $request->filled('order')) {
			return redirect()->back()->withErrors(['order' => 'You cannot assign an order to an unpublished category.'])->withInput();
		}

		// Check if the order already exists in the database
		if ($request->filled('order')) {
			$existingCategory = Category::where('order', $request->input('order'))->first();
			
			// If an existing category is found, set its order to null and status to 0
			if ($existingCategory) {
				$existingCategory->update([
					'order' => null, // Set the order to null
					'status' => 0    // Set the status to 0 (unpublished)
				]);
			}
		}

		// Generate a slug from the title
		$slug = Str::slug($request->input('title'));

		$file = $request->file('image');

		// Generate unique filename using the slug
		$filename = $slug . '.' . $file->getClientOriginalExtension();

		// Save the file to the storage/app/public/categories directory
		$path = $file->storeAs('public/images/categories', $filename);

		// Create a new category, ensuring order is only included if status is 1 or 2
		Category::create([
			'title' => $request->input('title'),
			'slug' => $slug,
			'description' => $request->input('description'),
			'image' => basename($path),
			'parent_id' => $request->input('parent_id'), // Parent category if applicable
			'order' => in_array($request->input('status'), [1, 2]) ? $request->input('order') : null, // Assign order only if status is 1 or 2
			'status' => $request->input('status'), // Set status based on request
		]);

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
		$sections = Section::all();
		$categories = Category::all();
        // Category image path
		$categoryPath = $this->getCategoryPath();

		// Return the view with the slider data
		return view('backEnd.categories.edit', [
			'category' => $category,
			'categoryPath' => $categoryPath,
			'categories' => $categories,
			'sections' => $sections,
		]);
    }

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, Category $category)
	{
		// Define base validation rules
		$rules = [
			'title' => 'required|string|max:255|unique:categories,title,' . $category->id, // Exclude the current category from unique validation
			'slug' => 'unique:categories,slug,' . $category->id, // Exclude the current category from unique slug validation
			'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // Image validation, nullable for update
			'description' => 'required|string',
			'parent_id' => 'nullable|exists:categories,id', // Parent ID should exist in the categories table
		];

		// Add order validation rule based on status
		if (in_array($request->input('status'), [1, 2])) {
			$rules['order'] = 'required|integer'; // Order is required for Product and Item
		} else {
			$rules['order'] = 'nullable|integer'; // Order is nullable for Unpublished
		}

		// Validate the request with the defined rules
		$request->validate($rules);

		// Custom validation to ensure 'order' is not set when status is 0
		if ($request->input('status') == 0 && $request->filled('order')) {
			return redirect()->back()->withErrors(['order' => 'You cannot assign an order to an unpublished category.'])->withInput();
		}

		// Check if the order already exists in the database
		if ($request->filled('order')) {
			$existingCategory = Category::where('order', $request->input('order'))
				->where('id', '!=', $category->id) // Ensure the current category is excluded
				->first();

			// If an existing category is found, set its order to null and status to 0
			if ($existingCategory) {
				$existingCategory->update([
					'order' => null, // Set the order to null
					'status' => 0    // Set the status to 0 (unpublished)
				]);
			}
		}

		// Generate a slug from the title
		$slug = Str::slug($request->input('title'));

		// Check if an image is uploaded
		if ($request->hasFile('image')) {
			$file = $request->file('image');

			// Generate unique filename using the slug
			$filename = $slug . '.' . $file->getClientOriginalExtension();

			// Save the file to the storage/app/public/categories directory
			$path = $file->storeAs('public/images/categories', $filename);

			// Update the category with the new image
			$category->update([
				'image' => basename($path), // Update the image field with the new filename
			]);
		}

		// Update the category's other fields
		$category->update([
			'title' => $request->input('title'),
			'slug' => $slug,
			'description' => $request->input('description'),
			'parent_id' => $request->input('parent_id'), // Parent category if applicable
			'order' => in_array($request->input('status'), [1, 2]) ? $request->input('order') : null, // Assign order only if status is 1 or 2
			'status' => $request->input('status'), // Set status based on request
		]);

		return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
	}




	



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
	{
		 // Find the slider by its ID
		 $category = Category::findOrFail($id);

		 // Check if the image exists and delete it using Storage
		 if (Storage::disk('public')->exists('images/categories/' . $category->image)) {
			 Storage::disk('public')->delete('images/categories/' . $category->image);
		 }
	 
		 // Delete the slider record from the database
		 $category->delete();
	 
		 // Redirect back with a success message
		 return redirect()->back()->with('success', 'Category deleted successfully.');
	}

}
