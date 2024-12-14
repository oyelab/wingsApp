<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


class ReviewController extends Controller
{

	public function updateStatus(Request $request, $id)
	{
		$review = Review::findOrFail($id);
		$review->status = $request->status;
		$review->save();

		return response()->json(['success' => true]);
	}

	

    /**
     * Display a listing of the resource.
     */
	public function index()
	{
		// Fetch all reviews with related user and product information
		$reviews = Review::with(['user', 'products'])->latest()->paginate(10); // Paginate to show 10 reviews per page
	
		// return $review->ratingStars;
		// Return the reviews index view with the reviews data
		return view('backEnd.reviews.index', compact('reviews'));
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
			'item' => 'nullable|exists:products,id', // Validate that the product ID exists
			'order_id' => 'nullable|exists:orders,id', // Validate the order ID if provided
			'username' => auth()->check() ? 'nullable|string' : 'required|string',
		]);

		// Create the review
		$review = new Review();
		$review->user_id = auth()->id(); // Set user_id if the user is authenticated
		$review->content = $validated['content'];

		// Only set username if no user is authenticated
		if (!$review->user_id) {
			$review->username = $validated['username'];
		}

		$review->rating = number_format($validated['rating'], 1); // Ensure the rating is stored as a decimal
		$review->status = false; // Set review status as inactive by default
		$review->save();

		// Handle order or product association if applicable
		if (!empty($validated['order_id'])) {
			// Get the order based on the order_id
			$order = Order::findOrFail($validated['order_id']);

			// Get all the products associated with this order
			$products = $order->products; // Using the 'products' relationship defined in the Order model

			// Create an array of product IDs to associate with the review
			$productIds = $products->pluck('id')->toArray();

			// Use 'syncWithoutDetaching' to ensure the current product remains associated
			$review->products()->syncWithoutDetaching($productIds);
		} elseif (!empty($validated['item'])) {
			// If no order ID, associate the review with the product from the form
			$itemId = $validated['item']; // Get the product ID from the form
			$review->products()->attach($itemId);
		}

		// Redirect or return a response
		return redirect()->back()->with('success', 'Your review has been submitted for approval!');
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
    public function edit($id)
    {
        $review = Review::findOrFail($id);
    	return view('backEnd.reviews.editReviewModal', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, Review $review)
	{
		// Validate the incoming data
		$validated = $request->validate([
			'content' => 'required|string|max:1000',
			'rating' => 'required|numeric|between:1,5', // Validate decimal rating between 1.0 and 5.0
		]);

		// Update the review with the validated data
		$review->content = $validated['content'];
		$review->rating = number_format($validated['rating'], 1); // Ensure the rating has 1 decimal precision
		$review->save();

		// Redirect back with a success message
		return redirect()
			->route('reviews.index') // Redirect to the reviews index page
			->with('success', 'Review updated successfully.');
	}

	

    /**
     * Remove the specified resource from storage.
     */
	public function destroy(Review $review)
	{
		// Delete the review
		$review->delete();
	
		// Redirect or return a response as needed
		return redirect()->route('reviews.index')->with('success', 'Review deleted successfully');
	}
}
