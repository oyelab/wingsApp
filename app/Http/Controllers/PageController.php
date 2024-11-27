<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;




class PageController extends Controller
{
	public function getInTouch()
	{
		return view('frontEnd.pages.getInTouch');
	}
    /**
     * Display a listing of the resource.
     */

    public function help()
    {
		// Fetch all pages from the database
        $pages = Page::all();

        // Pass the pages to the view
        return view('frontEnd.pages.index', compact('pages'));
    }

	public function index()
    {
		// Fetch all pages from the database
        $pages = Page::orderBy('order', 'asc')->get();

		$menuTypes = [
			0 => 'None',  // Option for "None"
			1 => 'Footer Menu 1',
			2 => 'Footer Menu 2',
			3 => 'Behind Wings',
		];

        // Pass the pages to the view
        return view('backEnd.pages.index', compact('pages', 'menuTypes'));
    }

	public function show(Page $page)
    {
        // Fetch a single page by ID
        $page = Page::findOrFail($page);

        // Return the individual page view
        return view('frontEnd.page.show', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Page $page)
    {
		return view('backEnd.pages.create'); // Ensure this points to the correct Blade view file

    }

    /**
     * Store a newly created resource in storage.
     */
	public function store(Request $request)
	{
		// Validate the form data
		$request->validate([
			'title' => 'required|string|max:255|unique:pages,title',
			'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
			'content' => 'nullable|string',
		]);
	
		// Generate the slug
		$slug = Str::slug($request->title);
	
		// Handle the image upload if present
		$imagePath = null;
		$imageName = null;
	
		if ($request->hasFile('image')) {
			// Get the image from the request
			$image = $request->file('image');
	
			// Create an image instance using Intervention Image
			$imageInstance = Image::make($image);
	
			// Generate a base filename (slug)
			$baseName = $slug;
			$extension = 'webp';
	
			// Ensure the filename is unique by incrementing a counter
			$counter = 0;
			do {
				$imageName = $baseName . ($counter > 0 ? '-' . $counter : '') . '.' . $extension;
				$imagePath = 'public/pages/images/' . $imageName;
				$counter++;
			} while (Storage::exists($imagePath));
	
			// Resize and convert the image to webP format without reducing quality
			$imageInstance->encode('webp', 75); // Adjust quality if needed (75 is a good balance)
	
			// Save the image to the storage folder (not public)
			Storage::put($imagePath, $imageInstance->stream());
		}
	
		// Create a new page entry in the database
		Page::create([
			'title' => $request->title,
			'image' => $imageName,  // Store the unique path to the image
			'content' => $request->content,
			'slug' => $slug,
		]);
	
		// Redirect with success message
		return redirect()->route('pages.index')->with('success', 'Page created successfully.');
	}
	

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
		
		// return $page->image;

		return view('backEnd.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
	{
		// Validate the form data
		$request->validate([
			'title' => 'required|string|max:255|unique:pages,title,' . $id, // Exclude the current page from unique check
			'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
			'content' => 'nullable|string',
		]);

		// Find the page by ID
		$page = Page::findOrFail($id);

		// Generate the slug
		$slug = Str::slug($request->title);

		// Handle the image logic
		$imagePath = $page->imagePath; // Keep the current image path if no new image is uploaded
		$imageName = $page->image;     // Keep the current image name

		if ($request->hasFile('image')) {
			// Get the image from the request
			$image = $request->file('image');

			// Create an image instance using Intervention Image
			$imageInstance = Image::make($image);

			// Generate a base filename (slug)
			$baseName = $slug;
			$extension = 'webp';

			// Ensure the filename is unique by incrementing a counter
			$counter = 0;
			do {
				$imageName = $baseName . ($counter > 0 ? '-' . $counter : '') . '.' . $extension;
				$imagePath = 'public/pages/images/' . $imageName;
				$counter++;
			} while (Storage::exists($imagePath));

			// Resize and convert the image to webP format without reducing quality
			$imageInstance->encode('webp', 75); // Adjust quality if needed (75 is a good balance)

			// Delete the old image if it exists in storage
			if ($page->imagePath && Storage::exists($page->imagePath)) {
				Storage::delete($page->imagePath);
			}

			// Save the new image to the storage folder
			Storage::put($imagePath, $imageInstance->stream());
		} else if ($page->imagePath) {
			// Rename the old image if it exists
			$baseName = $slug;
			$counter = 0;
			do {
				$newImageName = $baseName . ($counter > 0 ? '-' . $counter : '') . '.webp';
				$newImagePath = 'public/pages/images/' . $newImageName;
				$counter++;
			} while (Storage::exists($newImagePath));

			if (Storage::exists($page->imagePath)) {
				Storage::move($page->imagePath, $newImagePath);
				$imagePath = $newImagePath;
				$imageName = $newImageName;
			}
		}

		// Update the page entry in the database
		$page->update([
			'title' => $request->title,
			'image' => $imageName,  // Store the path to the new image or keep the old one
			'content' => $request->content,
			'slug' => $slug,
		]);

		// Redirect with success message
		return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
	}



	public function updateType(Request $request, Page $page)
	{
		// Validate the incoming request
		$request->validate([
			'type' => 'nullable|integer|in:0,1,2,3,4,5', // Allow values 0, 1, or 2
		]);

		// Update only the 'type' field
		$page->update([
			'type' => $request->type,
		]);

		// Redirect back with success message
		return redirect()->route('pages.index')->with('success', 'Page type updated successfully.');
	}

	public function updateOrder(Request $request)
	{
		$order = $request->order;

		// Loop through the order array and update each page's order
		foreach ($order as $index => $pageData) {
			$page = Page::find($pageData['id']);
			$page->update(['order' => $pageData['order']]);
		}

		return response()->json(['success' => true]);
	}



    /**
     * Remove the specified resource from storage.
     */

	public function destroy(Page $page)
	{
		// Delete the page
		$page->delete();

		// Redirect back to the index page with a success message
		return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
	}

}
