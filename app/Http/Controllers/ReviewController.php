<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
		// Validate input
		$validated = $request->validate([
			'content' => 'required|string|max:1000',
			'rating' => 'required|integer|min:1|max:5', // Validates the rating value
			'order_id' => 'nullable|exists:orders,id', // Make sure the order exists if provided
		]);

		// Create the review
		$review = new Review();
		$review->user_id = auth()->id();
		$review->content = $validated['content'];
		$review->rating = number_format($validated['rating'], 1); // Ensure the rating is stored as a decimal with 1 decimal
		$review->status = true; // Review is active by default
		$review->save();

		// Check if 'order_id' is present in the validated data (it may not be if it's a site review)
		if (isset($validated['order_id']) && $validated['order_id']) {
			// Get the order based on the order_id
			$order = Order::findOrFail($validated['order_id']);
	
			// Get all the products associated with this order
			$products = $order->products; // Using the 'products' relationship defined in the Order model
	
			// Create an array of product IDs to associate with the review
			$productIds = $products->pluck('id')->toArray();
	
			// Use 'sync' to associate the review with the products and ensure uniqueness
			$review->products()->sync($productIds);
		}

		// Redirect or return a response
		return redirect()->back()->with('success', 'Your review has been submitted!');
	}

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
