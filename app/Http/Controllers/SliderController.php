<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SliderController extends Controller
{

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

		$file = $request->file('image');

		// Generate unique filename using the slug
		$filename = $slug . '.' . $file->getClientOriginalExtension();

		// Save the file to the storage/app/public/sliders directory
		$path = $file->storeAs('public/images/sliders', $filename);

		// Create a new slider, ensuring order is only included if status is 1
		Slider::create([
			'title' => $request->input('title'),
			'image' => basename($path),
			'order' => $request->input('status') == 1 ? $request->input('order') : null, // Assign order only if status is 1
			'status' => $request->input('status'), // Set status based on request
		]);

		return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
	}


	public function oldstore(Request $request)
	{

		// Define base validation rules
		$rules = [
			'title' => 'required|string|max:255|unique:sliders,title',
			'status' => 'required|boolean',
			'image' => 'required|mimes:jpeg,png,jpg,gif|max:4096|dimensions:ratio=21/8',
		];
	
		// Conditionally add the 'order' validation rule if the status is "publish" (status = 1)
		if ($request->input('status') == 1) {
			$rules['order'] = 'required|integer'; // Order is required when publishing
		} else {
			$rules['order'] = 'nullable|integer'; // Order can be nullable when saving
		}
	
		// Validate the request with the defined rules
		$request->validate($rules);
	
		// Generate a slug from the title
		$slug = Str::slug($request->input('title'));
	
		// Handle the image upload
		if ($request->hasFile('image')) {
			$file = $request->file('image');
	
			// Generate unique filename using the slug
			$filename = $slug . '.' . $file->getClientOriginalExtension();
	
			// Save the file to the storage/app/public/sliders directory
			$path = $file->storeAs('public/images/sliders', $filename);
	
			// If an order is provided, check if a slider with the same order already exists
			if ($request->filled('order')) {
				$existingSlider = Slider::where('order', $request->input('order'))->first();
	
				if ($existingSlider) {
					// Update the existing slider with the same order
					$existingSlider->update([
						'title' => $request->input('title'),
						'slug' => $slug,
						'image' => basename($path),
						'status' => $request->input('status'),
					]);
					return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
				}
			}
	
			// Create a new slider if no existing slider was found with the same order
			Slider::create([
				'title' => $request->input('title'),
				'image' => basename($path),
				'order' => $request->input('order'), // Nullable, only required if publishing
				'status' => $request->input('status'),
			]);
	
			return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
		}
	
		return back()->withErrors(['error' => 'Please fix the error & submit again!']);
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

		// Check if the user wants to remove the image
		if ($request->input('remove_image')) {
			// Prevent saving the slider if the image is removed
			return redirect()->back()->withErrors(['image' => 'Slider cannot be saved without an image.'])->withInput();
		}

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
			$filename = $slug . '.' . $file->getClientOriginalExtension();

			// Save the new file to the storage/app/public/sliders directory
			$path = $file->storeAs('public/images/sliders', $filename);
			
			// Update the slider with the new image name
			$slider->image = basename($path);
		} elseif ($slider->title !== $request->input('title')) {
			// Rename the existing image if the title has changed
			$oldImagePath = storage_path('app/public/images/sliders/' . $slider->image);
			
			// Generate the new image name based on the new slug
			$newFilename = $slug . '.' . pathinfo($slider->image, PATHINFO_EXTENSION);
			$newImagePath = storage_path('app/public/images/sliders/' . $newFilename);

			// Rename the old image file
			if (file_exists($oldImagePath)) {
				rename($oldImagePath, $newImagePath); // Rename the old image
			}

			// Update the slider with the new image name
			$slider->image = $newFilename; // Update the slider image field
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
