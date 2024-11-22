<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showcase;
use App\Models\ShowcaseDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShowcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showcases = Showcase::with('details')->get();

		// return $showcases;

		return view('backEnd.showcases.index', compact('showcases'));
    }

    public function showcases()
    {
        $showcases = Showcase::with('details')->get();

		return $showcases;

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
    public function create()
    {
        // Show the form to add a new wing
        return view('backEnd.showcases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
	public function store(Request $request)
	{
		// return $request;
		// Validate the incoming request data
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'short_description' => 'required|string|max:500',
			'banner' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
			'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
			'status' => 'required|boolean',
			'order' => 'required|integer|between:1,5',
			'details.*.heading' => 'required|string|max:255',
			'details.*.description' => 'required|string',
			'details.*.images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
		]);

		// Generate the slug for the showcase title
		$slug = Str::slug($validated['title']);
		
		// Ensure the slug is unique by checking if it exists in the database
		$originalSlug = $slug;
		$count = 1;
		while (Showcase::where('slug', $slug)->exists()) {
			// If the slug already exists, append a number to make it unique
			$slug = "{$originalSlug}-{$count}";
			$count++;
		}
		
		// Create the main showcase entry with the unique slug
		$showcase = Showcase::create([
			'title' => $validated['title'],
			'slug' => $slug,  // Store the generated unique slug
			'short_description' => $validated['short_description'],
			'status' => $validated['status'],
			'order' => $validated['order'],
		]);

		// Save the main banner and thumbnail images
		$showcase->banner = $this->storeImage($request->file('banner'), $showcase->id, $slug, 'banner');
		$showcase->thumbnail = $this->storeImage($request->file('thumbnail'), $showcase->id, $slug, 'thumbnail');
		$showcase->save();

		// Save details and process images
		foreach ($validated['details'] as $detail) {
			$headingSlug = Str::slug($detail['heading']);

			// Create the detail record
			$detailModel = ShowcaseDetail::create([
				'showcase_id' => $showcase->id,
				'heading' => $detail['heading'],
				'description' => $detail['description'],
			]);

			// Process and save images for the detail
			if (isset($detail['images'])) {
				$imageNames = [];
				foreach ($detail['images'] as $index => $image) {
					$extension = $image->getClientOriginalExtension();

					// Generate unique name for each image
					$imageName = "{$showcase->id}-{$detailModel->id}-{$headingSlug}-" . ($index + 1) . ".{$extension}";

					// Store the image
					$this->storeImage($image, $showcase->id, $slug, 'details', $imageName);

					// Collect the image name (without path)
					$imageNames[] = $imageName;
				}

				// Save the image names as JSON in the `images` column
				$detailModel->images = json_encode($imageNames);
				$detailModel->save();
			}
		}

		return redirect()->route('showcases.index')->with('success', 'Showcase created successfully.');
	}

		
	
	
	// Helper function to store images
	private function storeImage($image, $showcaseId, $slug, $folder, $customName = null)
	{
		// Determine the file name
		$fileName = $customName ?: "{$showcaseId}-{$slug}-{$folder}.{$image->extension()}";
	
		// Store the image in the specified directory
		$image->storeAs("public/showcases/{$showcaseId}/{$folder}", $fileName);
	
		return $fileName; // Return only the file name
	}
	
	
	private function storeDetailImage($image, $showcaseId, $detailId, $slug)
	{
		// Generate a unique name for the image
		$imageName = $showcaseId . $detailId . '-' . time() . '.' . $image->extension();
		$image->storeAs('public/showcases', $imageName); // Store in public/showcases directory
		return $imageName; // Return the image name
	}

	

    /**
     * Display the specified resource.
     */

	

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Showcase $showcase)
	{
		// Pass the showcase model data to the view for editing
		return view('backEnd.showcases.edit', compact('showcase'));
	}


    /**
     * Update the specified resource in storage.
     */
	
	public function update(Request $request, Showcase $showcase)
	{
		// return $showcase;
		// Validate request
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'order' => 'required|integer|min:1|max:5',
			'short_description' => 'nullable|string',
			'banner' => 'nullable|image|max:2048',
			'thumbnail' => 'nullable|image|max:2048',
			'status' => 'required|boolean',
			'details.*.heading' => 'nullable|string|max:255',
			'details.*.description' => 'nullable|string',
			'details.*.images.*' => 'nullable|image|max:2048',
		]);
	
		// Update main showcase data
		$showcase->title = $validated['title'];
		$showcase->order = $validated['order'];
		$showcase->short_description = $validated['short_description'];
		$showcase->status = $validated['status'];
	
		// Handle banner image
		if ($request->hasFile('banner')) {
			if ($showcase->banner) {
				Storage::disk('public')->delete($showcase->banner);
			}
			$showcase->banner = $request->file('banner')->store('showcase_banners', 'public');
		} elseif ($request->input('banner_old')) {
			$showcase->banner = $request->input('banner_old');
		}
	
		// Handle thumbnail image
		if ($request->hasFile('thumbnail')) {
			if ($showcase->thumbnail) {
				Storage::disk('public')->delete($showcase->thumbnail);
			}
			$showcase->thumbnail = $request->file('thumbnail')->store('showcase_thumbnails', 'public');
		} elseif ($request->input('thumbnail_old')) {
			$showcase->thumbnail = $request->input('thumbnail_old');
		}
	
		$showcase->save();
	
		// Handle details
		$details = $request->input('details', []);
		foreach ($details as $index => $detail) {
			// Find or create the showcase detail
			$showcaseDetail = ShowcaseDetail::find($detail['id'] ?? null) ?? new ShowcaseDetail();
			$showcaseDetail->showcase_id = $showcase->id;
			$showcaseDetail->heading = $detail['heading'] ?? null;
			$showcaseDetail->description = $detail['description'] ?? null;
	
			// Handle detail images
			$images = $detail['images_old'] ?? []; // Keep existing images
			if (isset($detail['images'])) {
				foreach ($detail['images'] as $imageFile) {
					$images[] = $imageFile->store('showcase_details', 'public');
				}
			}
	
			$showcaseDetail->images = json_encode($images); // Store as JSON
			$showcaseDetail->save();
		}
	
		// Handle removed details
		$existingDetailIds = collect($details)->pluck('id')->filter()->toArray();
		$showcase->details()->whereNotIn('id', $existingDetailIds)->delete();
	
		return redirect()->route('showcases.index')->with('success', 'Showcase updated successfully!');
	}
	


    /**
     * Remove the specified resource from storage.
     */
	public function destroy(Showcase $showcase)
	{
		try {
			// Helper function to delete an image file dynamically
			$deleteImage = function ($path) {
				if ($path && Storage::exists("public/$path")) {
					Storage::delete("public/$path");
				}
			};
	
			// Delete the showcase banner and thumbnail using their paths
			$deleteImage("showcases/{$showcase->id}/banner/{$showcase->banner}");
			$deleteImage("showcases/{$showcase->id}/thumbnail/{$showcase->thumbnail}");
	
			// Delete associated showcase details and their images
			foreach ($showcase->details as $detail) {
				$imagePaths = json_decode($detail->images, true) ?? [];
				foreach ($imagePaths as $image) {
					$deleteImage("showcases/{$showcase->id}/details/{$image}");
				}
				$detail->delete(); // Delete the detail record
			}
	
			// Delete the showcase record itself
			$showcase->delete();
	
			return redirect()->route('showcases.index')->with('success', 'Showcase deleted successfully.');
		} catch (\Exception $e) {
			return redirect()->route('showcases.index')->with('error', 'Failed to delete showcase: ' . $e->getMessage());
		}
	}
	
}
