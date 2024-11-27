<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showcase;
use App\Models\ShowcaseDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image; // Make sure to include this at the top of your file


class ShowcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showcases = Showcase::orderBy('order', 'asc')->get();

		// return $showcases;

		return view('backEnd.showcases.index', compact('showcases'));
    }

    public function showcases()
    {
        $showcases = Showcase::with('details')->get();

		dd($showcases);

		return view('backEnd.showcases.index', compact('showcases'));
    }

	public function show($slug)
	{
		// Fetch the showcase with its details (images loaded via the accessor)
		$showcase = Showcase::where('slug', $slug)
							->with('details') // Eager load the details
							->firstOrFail(); // Returns 404 if not found

		// return $showcase;

		// Return the show page with the showcase data
		return view('frontEnd.showcases.show', compact('showcase'));
	}

	

    /**
     * Show the form for creating a new resource.
     */
    public function create(Showcase $showcase)
    {
        // Show the form to add a new wing
        return view('backEnd.showcases.create', compact('showcase'));
    }

    /**
     * Store a newly created resource in storage.
     */


	public function store(Request $request)
	{
		// return $request;
		// Validate the incoming request data for the showcase
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'short_description' => 'nullable|string|max:500',
			'banners' => 'required|array|min:1', // Ensure 'banners' is an array and has at least one file
			'banners.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // Validate each file in the 'banners' array
			'thumbnail' => [
				'required',
				'image',
				'mimes:jpg,jpeg,png,gif',
				'max:2048',
				function ($attribute, $value, $fail) use ($request) {
					// Same ratio validation logic for the thumbnail
					$order = $request->input('order');
					$allowedRatios = [
						1 => [3.76, 5],
						2 => [3.76, 5],
						3 => [7.82, 4.7],
						4 => [5, 6.2],
						5 => [5, 3.5],
					];
	
					if (isset($allowedRatios[$order])) {
						[$width, $height] = $allowedRatios[$order];
						$image = Image::make($value);
						$actualRatio = $image->width() / $image->height();
						$expectedRatio = $width / $height;
	
						if (abs($actualRatio - $expectedRatio) > 0.01) {
							$fail("The {$attribute} must have a ratio of {$width}x{$height} for order {$order}.");
						}
					}
				},
			],
			'status' => 'required|boolean',
			'order' => 'nullable|integer|between:1,5',
		]);
	
		// Check if a showcase with the same order already exists
		$existingShowcase = Showcase::where('order', $validated['order'])->first();
		if ($existingShowcase) {
			// Detach the order by setting it to null
			$existingShowcase->update(['order' => null]);
		}
	
		// Generate the slug for the showcase title
		$slug = Str::slug($validated['title']);
	
		// Ensure the slug is unique by checking if it exists in the database
		$originalSlug = $slug;
		$count = 1;
		while (Showcase::where('slug', $slug)->exists()) {
			$slug = "{$originalSlug}-{$count}";
			$count++;
		}
	
		// Initialize an array to store banner file names
		$banners = [];
	
		// Save multiple banner images
		if ($request->hasFile('banners')) {
			foreach ($request->file('banners') as $index => $banner) {
				$bannerName = $this->storeImage($banner, $slug, "banner-{$index}");
				$banners[] = $bannerName; // Add file name to the array
			}
		}
	
		// Create the main showcase entry with the unique slug and save banners as JSON
		$showcase = Showcase::create([
			'title' => $validated['title'],
			'slug' => $slug,
			'short_description' => $validated['short_description'],
			'status' => $validated['status'],
			'order' => $validated['order'],
			'thumbnail' => $this->storeImage($request->file('thumbnail'), $slug, 'thumbnail'),
			'banners' => json_encode($banners), // Save banners as JSON
		]);
	
		// After saving the showcase, redirect to a page where you can add the details
		return redirect()->route('showcases.index')->with('success', 'Showcase created successfully. You can now add details.');
	}
	 

	// Helper function to store images (banner and thumbnail)
	private function storeImage($image, $slug, $folder)
	{
		// Generate a simple file name using the slug and folder type
		$fileName = "{$slug}-{$folder}.webp"; // Save as .webp extension
	
		// Define the directory path
		$directory = storage_path("app/public/showcases/{$slug}"); // Save directly in the 'showcases' directory
	
		// Make sure the directory exists before storing
		if (!file_exists($directory)) {
			mkdir($directory, 0777, true); // Set permissions to 0777, recursively
		}
	
		// Open the image using Intervention Image
		$img = Image::make($image);
	
		// Convert the image to WebP and save with 75% quality, no cropping
		$img->encode('webp', 75) // Convert to WebP format with 75% quality
			->save("{$directory}/{$fileName}"); // Save the image to the specified path
	
		return $fileName; // Return only the image name
	}
	


    /**
     * Display the specified resource.
     */

	

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Showcase $showcase)
	{
		// return $showcase;
		// Pass the showcase model data to the view for editing
		return view('backEnd.showcases.edit', compact('showcase'));
	}


    /**
     * Update the specified resource in storage.
     */
	
	 public function update(Request $request, Showcase $showcase)
	 {
		// return $request;
		 // Validate the incoming request data for the showcase
		 $validated = $request->validate([
			 'title' => 'required|string|max:255',
			 'short_description' => 'nullable|string|max:500',
			 'banners' => 'nullable|array|min:1', // Banners are optional
			 'banners.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // Validate each file in the banners array
			 'thumbnail' => [
				 'nullable', // Thumbnail is optional
				 'image',
				 'mimes:jpg,jpeg,png,gif',
				 'max:2048',
				 function ($attribute, $value, $fail) use ($request) {
					 $order = $request->input('order');
					 $allowedRatios = [
						 1 => [3.76, 5],
						 2 => [3.76, 5],
						 3 => [7.82, 4.7],
						 4 => [3.76, 5],
						 5 => [5, 3.5],
					 ];
	 
					 if (isset($allowedRatios[$order])) {
						 [$width, $height] = $allowedRatios[$order];
						 $image = Image::make($value);
						 $actualRatio = $image->width() / $image->height();
						 $expectedRatio = $width / $height;
	 
						 if (abs($actualRatio - $expectedRatio) > 0.01) {
							 $fail("The {$attribute} must have a ratio of {$width}x{$height} for order {$order}.");
						 }
					 }
				 },
			 ],
			 'status' => 'required|boolean',
			 'order' => 'nullable|integer|between:1,5',
		 ]);
	 
		 // Check if the order needs to be detached from another showcase
		 if ($validated['order'] && $validated['order'] != $showcase->order) {
			 $existingShowcase = Showcase::where('order', $validated['order'])->first();
			 if ($existingShowcase) {
				 $existingShowcase->update(['order' => null]);
			 }
		 }
	 
		 // Update slug if the title has changed
		 if ($showcase->title !== $validated['title']) {
			 $slug = Str::slug($validated['title']);
			 $originalSlug = $slug;
			 $count = 1;
			 while (Showcase::where('slug', $slug)->where('id', '!=', $showcase->id)->exists()) {
				 $slug = "{$originalSlug}-{$count}";
				 $count++;
			 }
			 $validated['slug'] = $slug;
		 }
	 
		 // Initialize an array for new banners
		 $banners = json_decode($showcase->banners, true) ?? [];
	 
		 // Handle new banner uploads
		 if ($request->hasFile('banners')) {
			 foreach ($request->file('banners') as $index => $banner) {
				 $bannerName = $this->storeImage($banner, $showcase->slug ?? $validated['slug'], "banner-" . (count($banners) + $index));
				 $banners[] = $bannerName;
			 }
		 }
	 
		 // Handle thumbnail upload
		 if ($request->hasFile('thumbnail')) {
			 $thumbnailName = $this->storeImage($request->file('thumbnail'), $showcase->slug ?? $validated['slug'], 'thumbnail');
			 $validated['thumbnail'] = $thumbnailName;
		 }
	 
		 // Update the showcase
		 $showcase->update(array_merge($validated, ['banners' => json_encode($banners)]));
	 
		 return redirect()->route('showcases.index')->with('success', 'Showcase updated successfully.');
	 }
	 


    /**
     * Remove the specified resource from storage.
     */
	public function destroy(Showcase $showcase)
	{
		// Check if the showcase has a thumbnail and delete the image
		if ($showcase->thumbnail) {
			$this->deleteImage($showcase->slug, $showcase->thumbnail);
		}
	
		// Check if the showcase has banners and delete each image
		if ($showcase->banners) {
			$banners = json_decode($showcase->banners, true);
			foreach ($banners as $banner) {
				$this->deleteImage($showcase->slug, $banner);
			}
		}
	
		// Delete the showcase record from the database
		$showcase->delete();
	
		// Redirect to the showcase index page with a success message
		return redirect()->route('showcases.index')->with('success', 'Showcase deleted successfully.');
	}

	// Helper method to delete images from the storage
	private function deleteImage($slug, $fileName)
	{
		$filePath = storage_path("app/public/showcases/{$slug}/{$fileName}");

		// Check if the file exists and delete it
		if (file_exists($filePath)) {
			unlink($filePath);
		}
	}

	
	
}
