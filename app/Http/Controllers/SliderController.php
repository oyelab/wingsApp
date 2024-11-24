<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('role'); // Only allow role 1 users

    }

	 // Private function to get the slider path
	 private function getSliderPath()
	 {
		return Storage::url('public/images/sliders/');
	 }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		  // Get the search query from the request
		$search = $request->input('search');

		// Fetch sliders and filter based on the search query
		$sliders = Slider::when($search, function($query, $search) {
			return $query->where('title', 'like', '%' . $search . '%');
		})->get();
	
		$sliders = Slider::orderBy('order', 'desc')->get();
        $sliderPath = $this->getSliderPath(); // Call the private function

		// return $sliderPath;

        return view('backEnd.sliders.index', [
            'sliders' => $sliders,
            'sliderPath' => $sliderPath,
        ]);
    }

	
    
	public function create()
    {
        return view('backEnd.sliders.create');
    }

	
	public function store(Request $request)
	{
		// Define base validation rules
		$rules = [
			'title' => 'required|string|max:255|unique:sliders,title',
			'status' => 'required|boolean',
			'image' => 'required|mimes:jpeg,png,jpg,gif|max:4096',
		];
	
		// Conditionally add the 'order' validation rule
		if ($request->input('status') == 1) {
			$rules['order'] = 'required|integer'; // Order is required when publishing
		} else {
			$rules['order'] = 'nullable|integer'; // Make order nullable for saving
		}
	
		// Validate the request with the defined rules
		$request->validate($rules);
	
		// Custom validation to ensure 'order' is not set when status is 0
		if ($request->input('status') == 0 && $request->filled('order')) {
			return redirect()->back()->withErrors(['order' => 'You cannot set an order for a saved slider.'])->withInput();
		}
	
		// Check if the order already exists in the database
		if ($request->filled('order')) {
			$existingSlider = Slider::where('order', $request->input('order'))->first();
	
			// If an existing slider is found, set its order to null and status to 0
			if ($existingSlider) {
				$existingSlider->update([
					'order' => null,   // Set the order to null
					'status' => 0      // Set the status to 0 (not published)
				]);
			}
		}
	
		// Generate a slug from the title
		$slug = Str::slug($request->input('title'));
	
		// Get the uploaded image file
		$file = $request->file('image');
	
		// Generate a unique filename using the slug and WebP extension
		$filename = $slug . '.webp';
	
		$image = Image::make($file)
			->encode('webp', 85); // Reduce quality to 85% for WebP format
	
		// Save the file to the desired location in the storage path
		$path = storage_path('app/public/images/sliders/' . $filename);
		$image->save($path);
	
		// Save the slider details in the database (only the image filename)
		Slider::create([
			'title' => $request->input('title'),
			'image' => $filename, // Save only the filename
			'order' => $request->input('status') == 1 ? $request->input('order') : null, // Assign order only if status is 1
			'status' => $request->input('status'), // Set status based on request
		]);
	
		return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
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
    public function edit(Slider $slider)
    {
        // Slider image path
		$sliderPath = $this->getSliderPath();

		// Return the view with the slider data
		return view('backEnd.sliders.edit', [
			'slider' => $slider,
			'sliderPath' => $sliderPath,
		]);
    }

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, $id)
	{
		// Find the slider by its ID
		$slider = Slider::findOrFail($id);
	
		// Define base validation rules
		$rules = [
			'title' => 'required|string|max:255|unique:sliders,title,' . $slider->id,
			'status' => 'required|boolean',
			'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:4096',
		];
	
		// Conditionally add the 'order' validation rule
		if ($request->input('status') == 1) {
			$rules['order'] = 'required|integer'; // Order is required when publishing
		} else {
			$rules['order'] = 'nullable|integer'; // Make order nullable for saving
		}
	
		// Validate the request with the defined rules
		$request->validate($rules);
	
		// Custom validation to ensure 'order' is not set when status is 0
		if ($request->input('status') == 0 && $request->filled('order')) {
			return redirect()->back()->withErrors(['order' => 'You cannot set an order for a saved slider.'])->withInput();
		}
	
		// Check if the order already exists in the database
		if ($request->filled('order')) {
			$existingSlider = Slider::where('order', $request->input('order'))->first();
	
			// If an existing slider is found, set its order to null and status to 0
			if ($existingSlider && $existingSlider->id !== $slider->id) {
				$existingSlider->update([
					'order' => null,   // Set the order to null
					'status' => 0      // Set the status to 0 (not published)
				]);
			}
		}
	
		// Generate a slug from the title
		$slug = Str::slug($request->input('title'));
	
		// Check if a new image is uploaded
		if ($request->hasFile('image')) {
			// Delete the old image if it exists
			$oldImagePath = storage_path('app/public/images/sliders/' . $slider->image);
			if (file_exists($oldImagePath)) {
				unlink($oldImagePath); // Delete the old image
			}
	
			// Get the new image file
			$file = $request->file('image');
	
			// Generate unique filename using the slug
			$filename = $slug . '.webp'; // Convert to WebP format
	
			// Use Intervention Image to compress, resize, and save the new image
			$image = Image::make($file)
				->encode('webp', 85); // Reduce quality to 85% for WebP format
	
			// Save the processed image to the desired location
			$path = storage_path('app/public/images/sliders/' . $filename);
			$image->save($path);
	
			// Update the slider with the new image filename
			$slider->image = $filename;
		} elseif ($slider->title !== $request->input('title')) {
			// Rename the existing image if the title has changed
			$oldImagePath = storage_path('app/public/images/sliders/' . $slider->image);
	
			// Generate the new image name based on the new slug
			$newFilename = $slug . '.webp'; // Keep consistent with WebP format
			$newImagePath = storage_path('app/public/images/sliders/' . $newFilename);
	
			// Rename the old image file
			if (file_exists($oldImagePath)) {
				rename($oldImagePath, $newImagePath); // Rename the old image
			}
	
			// Update the slider with the new image filename
			$slider->image = $newFilename;
		}
	
		// Update the slider details
		$slider->title = $request->input('title');
		$slider->order = $request->input('status') == 1 ? $request->input('order') : null; // Assign order only if status is 1
		$slider->status = $request->input('status'); // Set status based on request
	
		// Save the updated slider
		$slider->save();
	
		return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
	}
	



	



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
	{
		 // Find the slider by its ID
		 $slider = Slider::findOrFail($id);

		 // Check if the image exists and delete it using Storage
		 if (Storage::disk('public')->exists('images/sliders/' . $slider->image)) {
			 Storage::disk('public')->delete('images/sliders/' . $slider->image);
		 }
	 
		 // Delete the slider record from the database
		 $slider->delete();
	 
		 // Redirect back with a success message
		 return redirect()->back()->with('success', 'Slider deleted successfully.');
	}

}
