<?php

namespace App\Http\Controllers;

use App\Models\Specification;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
	{
		// Retrieve products with their related quantities and categories, and paginate
		$products = Product::with('quantities', 'categories')->latest()->paginate(5);
		// return $products;
	
		foreach ($products as $product) {
			// Calculate the total quantity for each product
			$product->total_quantity = $product->quantities->sum('quantity');
	
			// Calculate the offer price and round it up
			if ($product->sale) {
				$offerPrice = $product->price * (1 - ($product->sale / 100)); // Calculate the offer price
				$product->offer_price = ceil($offerPrice); // Round it up to the nearest integer
			} else {
				$product->offer_price = null; // If there's no sale, set offer price to null
			}
	
			// Prepare the category display text
			$category_display = [];
	
			// Loop through the categories of the product to display category > subcategory
			foreach ($product->categories as $category) {
				// Get the parent category and subcategory from the pivot
				$parentCategory = Category::find($category->pivot->category_id); // Parent category
				$subCategory = Category::find($category->pivot->subcategory_id); // Subcategory
	
				// Format the display text as Category > Subcategory
				if ($parentCategory && $subCategory) {
					$category_display[] = $parentCategory->title . ' > ' . $subCategory->title;
				} else {
					$category_display[] = $category->title;
				}
			}
	
			// Save the category display to the product for later use in the view
			$product->category_display = implode(', ', $category_display); // Concatenate the display as a string
		}
	
		// Count total products
		$total = Product::count();
	
		// Count total published products
		$published = Product::where('status', 1)->count();
	
		// Count discounted products (assuming 'sale' field indicates discount)
		$discounted = Product::whereNotNull('sale')->count();
	
		// Count total quantities using the relationship
		$quantities = Product::with('quantities')->get()->sum(function ($product) {
			return $product->quantities->sum('quantity'); // Sum of quantities for each product
		});
	
		// Pack all data into a single variable
		$counts = [
			'total' => $total,
			'published' => $published,
			'discounted' => $discounted,
			'quantities' => $quantities,
		];
	
		// Pass the products with categories, quantities, and offer prices to the view
		return view('backEnd.specifications.index', [
			'products' => $products,
			'counts' => $counts,
		]);
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Specification $specification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specification $specification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specification $specification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specification $specification)
    {
        //
    }
}
