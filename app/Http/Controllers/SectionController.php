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
use App\Services\FileHandlerService;



class SectionController extends Controller
{
    protected $productRepo;
	protected $fileHandler;

	public function __construct(ProductRepository $productRepo, FileHandlerService $fileHandler)
    {
		$this->productRepo = $productRepo;

		$this->fileHandler = $fileHandler;

        $this->middleware('auth')->except('sections', 'show', 'shopPage');
		$this->middleware('role')->except('sections', 'show', 'shopPage'); // Only allow role 1 users
    }

    // public function __construct(ProductRepository $productRepo)
    // {
    //     $this->productRepo = $productRepo;
    // }
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
	
	
		// Create a new page entry in the database
		$section = Section::create([
			'title' => $request->title,
			'description' => $request->description,
			'status' => $request->status,
		]);

		// Check if a file is uploaded
		if ($request->hasFile('image')) {
			$file = $request->file('image');

			// Store the file and get only the filename
			$filename = $this->fileHandler->storeFile($file, 'sections');  // 'Asset' is the directory based on your model
			
			// Save the filename in the database
			$section->image = $filename;  // Assuming 'file_name' is a column in your 'assets' table

			$section->save();
		}
	
		// Redirect with success message
		return redirect()->route('sections.index')->with('success', 'Section created successfully.');
	}

	public function sections(Section $section)
	{
		// Define an array of available sections
		$sections = Section::all();
		$pagetitle = 'Sections';
		
		$section = null;
		$collection = null;
	
		return view('frontEnd.sections.index', compact('sections', 'pagetitle', 'section', 'collection'));
	}

	public function shopPage($section, Category $category)
	{
		// Fetch the section record from the database
		$sectionRecord = Section::where('slug', $section)->first();
		
		// If section is not found, use the default section or show a custom message
		if (!$sectionRecord) {
			// Optionally, redirect to a default section or show an alternative message.
			// return redirect()->route('default.section');  // Uncomment this if you want a redirection to a default section
			abort(404); // If you still want to keep the 404 behavior, you can keep it like this
		}
	
		$sectionTitle = $sectionRecord->title;
	
		// Check if sectionRecord has a scopeMethod
		if (!$sectionRecord->scopeMethod) {
			abort(404); // If no method is specified, abort with 404
		}
	
		// Ensure the method exists in the productRepo
		if (method_exists($this->productRepo, $sectionRecord->scopeMethod)) {
			// Call the corresponding method dynamically
			$products = $this->productRepo->{$sectionRecord->scopeMethod}();
		} else {
			abort(404); // Method does not exist in the repository
		}
	
		// Page title and section data
		$pageTitle = $sectionTitle;
		$title = "Title";
	
		// Return the view with the necessary data
		return view('frontEnd.sections.show', [
			'products' => $products,
			'title' => $title,
			'pagetitle' => $pageTitle,
			'section' => $sectionRecord ?? null, // Pass section if it exists
			'collection' => null, // Pass section if it exists
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
		// $categories = $product->categories;
		
		// return $slug;
		// Return the view with necessary data
		return view('frontEnd.products.show', [
			'slug' => $slug,
			'section' => $section,
			'product' => $product,
			'relatedProducts' => $relatedProducts,
			// 'categories' => $categories,
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


		// Check if a new file is uploaded
		if ($request->hasFile('image')) {
			$file = $request->file('image');

			// Delete the old file if it exists
			if ($section->image) {
				$this->fileHandler->deleteFile('sections/' . $section->image); // 'assets' directory is used
			}

			// Store the new file and update the filename in the database
			$filename = $this->fileHandler->storeFile($file, 'sections');
			$section->image = $filename; // Assuming 'file' is the column for filename

			$section->save();
		}

		// Update the page entry in the database
		$section->update([
			'title' => $request->title,
			'description' => $request->description,
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