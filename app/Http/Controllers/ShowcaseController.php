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
	public function __construct()
    {
        $this->middleware('auth')->except('show' );;
		$this->middleware('role')->except('show' );; // Only allow role 1 users

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showcases = Showcase::orderBy('order', 'asc')->get();

		// return $showcases;

		return view('backEnd.showcases.index', compact('showcases'));
    }

    // public function showcases()
    // {
    //     $showcases = Showcase::all();

	// 	return $showcases;

	// 	return view('backEnd.showcases.index', compact('showcases'));
    // }

	public function show($slug)
	{
		// Fetch the showcase with its details (images loaded via the accessor)
		$showcase = Showcase::where('slug', $slug)
							->where('status', true)
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
		 // Validate the incoming request data for the showcase
		 $validated = $request->validate([
			 'title' => 'required|string|max:255',
			 'short_description' => 'nullable|string|max:500',
			 'banners' => 'required|array|min:1',
			 'banners.*' => 'image|mimes:jpg,jpeg,png,gif',
			 'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif',
			 'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
			 'status' => 'required|boolean',
			 'order' => 'nullable|integer|between:1,5',
		 ]);
	 
		 // Check if a showcase with the same order already exists
		 $existingShowcase = Showcase::where('order', $validated['order'])->first();
		 if ($existingShowcase) {
			 $existingShowcase->update(['order' => null]);
		 }
	 
		 // Generate the slug for the showcase title
		 $slug = Str::slug($validated['title']);
		 $originalSlug = $slug;
		 $count = 1;
		 while (Showcase::where('slug', $slug)->exists()) {
			 $slug = "{$originalSlug}-{$count}";
			 $count++;
		 }
	 
		 // Create the main showcase entry (without banners and thumbnail)
		 $showcase = Showcase::create([
			 'title' => $validated['title'],
			 'slug' => $slug,
			 'short_description' => $validated['short_description'],
			 'status' => $validated['status'],
			 'order' => $validated['order'],
		 ]);
	 
		 $id = $showcase->id; // Get the ID of the created showcase
	 
		 // Initialize an array to store banner file names
		 $banners = [];
	 
		 // Save multiple banner images
		 if ($request->hasFile('banners')) {
			 foreach ($request->file('banners') as $index => $banner) {
				 $bannerName = $this->storeImage($banner, $id, "banner-{$index}");
				 $banners[] = $bannerName; // Add file name to the array
			 }
		 }
	 
		 // Save the thumbnail
		 $thumbnailName = $this->storeImage($request->file('thumbnail'), $id, 'thumbnail');
		 $ogImageName = $this->storeImage($request->file('og_image'), $id, 'og_image');
	 
		 // Update the showcase with the banners and thumbnail
		 $showcase->update([
			 'thumbnail' => $thumbnailName,
			 'og_image' => $ogImageName,
			 'banners' => json_encode($banners), // Save banners as JSON
		 ]);
	 
		 return redirect()->route('showcases.index')->with('success', 'Showcase created successfully. You can now add details.');
	 }
	 
	 // Updated helper function to store images
	 private function storeImage($image, $id, $folder)
	 {
		 // Generate a unique file name using UUID and the original file extension
		 $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
	 
		 // Define the directory path using ID
		 $directory = storage_path("app/public/showcases/{$id}");
	 
		 // Ensure the directory exists
		 if (!file_exists($directory)) {
			 mkdir($directory, 0777, true);
		 }
	 
		 // Save the image in the directory
		 $path = "{$directory}/{$fileName}";
		 $image->move($directory, $fileName);
	 
		 return $fileName;
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
		 // Validate the incoming request data for the showcase
		 $validated = $request->validate([
			 'title' => 'required|string|max:255',
			 'short_description' => 'nullable|string|max:500',
			 'banners' => 'nullable|array|min:1', // Banners are optional
			 'banners.*' => 'image|mimes:jpg,jpeg,png,gif', // Validate each file in the banners array
			 'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif',
			 'og_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
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
	 
		 // Delete old banner files if new banners are uploaded
		 if ($request->hasFile('banners')) {
			 foreach ($banners as $oldBanner) {
				 $oldPath = storage_path("app/public/showcases/{$showcase->id}/{$oldBanner}");
				 if (file_exists($oldPath)) {
					 unlink($oldPath);
				 }
			 }
			 $banners = []; // Reset the banners array
	 
			 // Save new banner images
			 foreach ($request->file('banners') as $index => $banner) {
				 $bannerName = $this->storeImage($banner, $showcase->id, "banner-" . $index);
				 $banners[] = $bannerName;
			 }
		 }
	 
		 // Handle thumbnail upload and delete the old one if necessary
		 if ($request->hasFile('thumbnail')) {
			 $oldThumbnail = $showcase->thumbnail;
			 if ($oldThumbnail) {
				 $oldPath = storage_path("app/public/showcases/{$showcase->id}/{$oldThumbnail}");
				 if (file_exists($oldPath)) {
					 unlink($oldPath);
				 }
			 }
			 $thumbnailName = $this->storeImage($request->file('thumbnail'), $showcase->id, 'thumbnail');
			 $validated['thumbnail'] = $thumbnailName;
		 }
		 // Handle og_image upload and delete the old one if necessary
		 if ($request->hasFile('og_image')) {
			 $oldOgImage = $showcase->og_image;
			 if ($oldOgImage) {
				 $oldPath = storage_path("app/public/showcases/{$showcase->id}/{$oldOgImage}");
				 if (file_exists($oldPath)) {
					 unlink($oldPath);
				 }
			 }
			 $ogImageName = $this->storeImage($request->file('og_image'), $showcase->id, 'og_image');
			 $validated['og_image'] = $ogImageName;
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
			$this->deleteImage($showcase->id, $showcase->thumbnail);
		}
	
		// Check if the showcase has banners and delete each image
		if ($showcase->banners) {
			$banners = json_decode($showcase->banners, true);
			foreach ($banners as $banner) {
				$this->deleteImage($showcase->id, $banner);
			}
		}
	
		// Delete the showcase record from the database
		$showcase->delete();
	
		// Redirect to the showcase index page with a success message
		return redirect()->route('showcases.index')->with('success', 'Showcase deleted successfully.');
	}

	// Helper method to delete images from the storage
	private function deleteImage($id, $fileName)
	{
		$filePath = storage_path("app/public/showcases/{$id}/{$fileName}");
		$directoryPath = storage_path("app/public/showcases/{$id}");
	
		// Check if the file exists and delete it
		if (file_exists($filePath)) {
			unlink($filePath);
		}
	
		// Check if the directory is empty and delete it
		if (is_dir($directoryPath) && count(scandir($directoryPath)) == 2) { // Only '.' and '..' remain
			rmdir($directoryPath);
		}
	}
	

	
	
}
