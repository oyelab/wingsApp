<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Models\Section;
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

	public function shopPage($section)
	{
		// Fetch the section record from the database
		$sectionRecord = Section::where('slug', $section)->first();
	
		if (!$sectionRecord || !$sectionRecord->scopeMethod) {
			abort(404); // Section not found or no method specified
		}
	
		// Ensure the method exists in the productRepo
		if (method_exists($this->productRepo, $sectionRecord->scopeMethod)) {
			// Call the corresponding method dynamically
			$products = $this->productRepo->{$sectionRecord->scopeMethod}(20); // Pass the number of products as needed
		} else {
			abort(404); // Method does not exist in the repository
		}

		return $products;
	
		return view('section', compact('products', 'section'));
	}
	
}