<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;
use Intervention\Image\Facades\Image;
use App\Services\FileHandlerService;

class SliderController extends Controller
{
	protected $fileHandler;

	public function __construct(FileHandlerService $fileHandler)
    {

		$this->fileHandler = $fileHandler;

        $this->middleware('auth');
		$this->middleware('role'); // Only allow role 1 users
    }

	 // Private function to get the slider path
	 private function getSliderPath()
	 {
		return Storage::url('public/sliders/');
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
			'image' => 'required|mimes:jpeg,png,jpg,gif,webp|max:4096',
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

		$filename = $this->fileHandler->storeFile($request->file('image'), 'sliders');  // 'sliders' is the directory

	
		// Save the slider details in the database (only the image filename)
		$slider = Slider::create([
			'title' => $request->input('title'),
			'order' => $request->input('status') == 1 ? $request->input('order') : null, // Assign order only if status is 1
			'status' => $request->input('status'), // Set status based on request
			'image' => $filename, // Save the image filename
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
		// Return the view with the slider data
		return view('backEnd.sliders.edit', [
			'slider' => $slider,
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
			'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:4096',
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

		
	
	// Update the slider fields
	$slider->fill($request->only(['title', 'order', 'status']));

	// If a new file is uploaded, handle it
	if ($request->hasFile('image')) {
		// Delete the old file if it exists
		$this->fileHandler->deleteFile("sliders/{$slider->image}");

		// Store the new image and get the filename
		$slider->image = $this->fileHandler->storeFile($request->file('image'), 'sliders');
	}

	// Save the updated slider
	$slider->save();
	
	return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
}
	



	



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
	{

		 // Check if the image exists and delete it using Storage
		 if (Storage::disk('public')->exists('sliders/' . $slider->image)) {
			 Storage::disk('public')->delete('sliders/' . $slider->image);
		 }
	 
		 // Delete the slider record from the database
		 $slider->delete();
	 
		 // Redirect back with a success message
		 return redirect()->back()->with('success', 'Slider deleted successfully.');
	}

}
