<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Models\Section;
use App\Models\Product;
use App\Models\Category;
class SectionController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
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
	
	
}