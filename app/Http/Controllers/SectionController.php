<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Models\Section;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class SectionController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function create(Section $section)
    {
		return view('backEnd.sections.create'); // Ensure this points to the correct Blade view file

    }

	public function store(Request $request)
	{
		// return $request;
		// Validate the form data
		$request->validate([
			'title' => 'required|string|max:255|unique:sections,title',
			'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
			'description' => 'nullable|string',
		]);
	
		// Generate the slug
		$slug = Str::slug($request->title);
		// return $slug;
	
		// Handle the image upload if present
		$imagePath = null;
		$imageName = null;

		if ($request->hasFile('image')) {
			// Get the image from the request
			$image = $request->file('image');
			
			// Create an image instance using Intervention Image
			$imageInstance = Image::make($image);
			
			// Generate a unique filename with a timestamp and original extension
			$timestamp = now()->format('YmdHisu'); // Format: YYYYMMDD_HHMMSS_microseconds
			$imageName = $timestamp . '.webp';
			
			// Resize and convert the image to webP format without reducing quality
			$imageInstance->encode('webp', 75); // Adjust quality if needed (90 is a good balance)
			
			// Save the image to the storage folder (not public)
			$imagePath = 'public/sections/' . $imageName;
			Storage::put($imagePath, $imageInstance->stream());
		}
	
		// Create a new page entry in the database
		Section::create([
			'title' => $request->title,
			'image' => $imageName,  // Store the path to the image
			'description' => $request->description,
			'slug' => $slug,
			'status' => $request->status,
		]);
	
		// Redirect with success message
		return redirect()->route('sections.index')->with('success', 'Section created successfully.');
	}

	public function sections(Section $section)
	{
		// Define an array of available sections
		$sections = Section::all();
	
		return $sections;
	}

	public function shopPage($section, Category $category)
	{
		// return $section->slug;
		// Fetch the section record from the database
		$sectionRecord = Section::where('slug', $section)->first();
		// return $sectionRecord;
		$sectionTitle = Section::where('slug', $section)->first()->title;

		// return $sectionTitle;

	
		if (!$sectionRecord || !$sectionRecord->scopeMethod) {
			abort(404); // Section not found or no method specified
		}
	
		// Ensure the method exists in the productRepo
		if (method_exists($this->productRepo, $sectionRecord->scopeMethod)) {
			// Call the corresponding method dynamically
			$products = $this->productRepo->{$sectionRecord->scopeMethod}(); // Pass the number of products as needed
		} else {
			abort(404); // Method does not exist in the repository
		}

		$pageTitle = $sectionTitle;
		$title = "Title";
		// return $section;
	
		return view('frontEnd.sections.show', [
			'products' => $products,
			'title' => $title,
			'pagetitle' => $pageTitle,
			'section' => $section ?? null, // Pass section if it exists
			'collection' => $collection ?? null, // Pass collection if it exists
		]);
	}

	public function show(Section $section, $slug)
	{
		// return $slug;
		// Find the product by its slug
		$product = Product::where('slug', $slug)->first();
	
		// If the product is not found, abort with a 404
		if (!$product) {
			abort(404, 'Product not found');
		}
	
		// Ensure the product matches the section's scope method
		if (!$this->isProductInSection($section, $product)) {
			abort(404, 'Product does not belong to this section');
		}
	
		// Increment the product's view count (if needed)
		$product->increment('views');
	
		// Get related products based on the current product
		$relatedProducts = Product::relatedProducts($product)->get();
	
		// Get the categories associated with the product
		$categories = $product->categories;
		
		// return $slug;
		// Return the view with necessary data
		return view('frontEnd.products.index', [
			'slug' => $slug,
			'section' => $section,
			'product' => $product,
			'relatedProducts' => $relatedProducts,
			'categories' => $categories,
			'collection' => null,
		]);
	}
	
	public function isProductInSection(Section $section, Product $product)
	{
		// Get the scope method stored in the section
		$scopeMethod = $section->scopeMethod;
	
		// Check if the method exists in the ProductRepository
		if (method_exists($this->productRepo, $scopeMethod)) {
			// Call the corresponding method dynamically to check if the product is in this section
			$products = $this->productRepo->{$scopeMethod}(10); // Fetch 10 products or any limit
	
			// Check if the product exists in the result
			return $products->contains('id', $product->id);
		}
	
		return false;
	}
	
	// Show the form for editing a specific section
	public function edit($id)
	{
		$section = Section::findOrFail($id);
		return view('backEnd.sections.edit', compact('section'));
	}

	public function index()
    {
        $sections = Section::all(); // You can also use paginate if you have a lot of sections
        return view('backEnd.sections.index', compact('sections'));
    }



	public function update(Request $request, $id)
	{

		$request->validate([
			'title' => 'required|string|max:255|unique:pages,title,' . $id, // Exclude the current page from unique check
			'description' => 'nullable|string', // Exclude the current page from unique check
			'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
		]);

		// dd($request->all());


		// Find the page by ID
		$section = Section::findOrFail($id);

		// Generate the slug
		$slug = Str::slug($request->title);

		// Handle the image upload if present
		$imagePath = $section->imagePath;  // Keep the current image path if no new image is uploaded
		$imageName = null;

		if ($request->hasFile('image')) {
			// Get the image from the request
			$image = $request->file('image');
			
			// Create an image instance using Intervention Image
			$imageInstance = Image::make($image);
			
			// Generate a unique filename with a timestamp and original extension
			$timestamp = now()->format('YmdHisu'); // Format: YYYYMMDD_HHMMSS_microseconds
			$imageName = $timestamp . '.webp';
			
			// Resize and convert the image to webP format without reducing quality
			$imageInstance->encode('webp', 75); // Adjust quality if needed (75 is a good balance)
			
			// Delete the old image if it exists in storage
			if ($section->imagePath && Storage::exists($section->imagePath)) {
				Storage::delete($section->imagePath);
			}
			
			// Save the new image to the storage folder (not public)
			$imagePath = 'public/sections/' . $imageName;
			Storage::put($imagePath, $imageInstance->stream());
		}

		// Update the page entry in the database
		$section->update([
			'title' => $request->title,
			'image' => $imageName,  // Store the path to the new image or keep the old one
			'description' => $request->description,
			'slug' => $slug,
			'status' => $request->status,
		]);

		// return $section;

		// Redirect with success message
		return redirect()->route('sections.index')->with('success', 'Section updated successfully.');
	}

	public function destroy(Section $section)
	{
		// Check if the section has an image and delete it from storage if exists
		if ($section->image && Storage::exists('public/sections/' . $section->image)) {
			Storage::delete('public/sections/' . $section->image);
		}

		// Delete the section record from the database
		$section->delete();

		// Redirect to sections index page with success message
		return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
	}
	
}