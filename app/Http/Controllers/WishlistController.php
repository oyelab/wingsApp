<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
	public function toggleWishlist(Request $request)
	{
		$productId = $request->product_id;
		$wishlist = session('wishlist', []);

		if (in_array($productId, $wishlist)) {
			// Remove the product from the wishlist
			$wishlist = array_diff($wishlist, [$productId]);
			$action = 'removed';
		} else {
			// Add the product to the wishlist
			$wishlist[] = $productId;
			$action = 'added';
		}

		session(['wishlist' => $wishlist]);

		return response()->json([
			'success' => true,
			'action' => $action,
			'wishlist_count' => count($wishlist),
		]);
	}

	
    // This method handles the addition of products to the wishlist
	public function addToWishlist(Request $request)
	{
		$productId = $request->input('product_id');
		
		// Fetch product if needed for validation (optional step)
		$product = Product::find($productId);
		
		if (!$product) {
			return response()->json([
				'success' => false,
				'message' => 'Product not found.'
			]);
		}
	
		// Get current wishlist from session, or initialize an empty array
		$wishlist = session()->get('wishlist', []);
	
		// Add the product to the wishlist if not already added
		if (!in_array($productId, $wishlist)) {
			$wishlist[] = $productId;
			session()->put('wishlist', $wishlist);
		}
	
		return response()->json([
			'success' => true,
			'message' => 'Product added to wishlist!',
			'wishlist_count' => count(session('wishlist'))
		]);
	}

	// Method to remove a product from the wishlist
    public function removeFromWishlist(Request $request)
    {
        $productId = $request->input('product_id');
        
        // Get the current wishlist from the session
        $wishlist = session()->get('wishlist', []);

        // If the product is in the wishlist, remove it
        if (($key = array_search($productId, $wishlist)) !== false) {
            unset($wishlist[$key]);
            session()->put('wishlist', $wishlist);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product removed from wishlist!',
            'wishlist_count' => count($wishlist)
        ]);
    }

	

    // This method displays the wishlist page
    public function index()
    {
        // Fetch all products in the wishlist based on stored IDs in session
        $wishlist = session()->get('wishlist', []);
        $products = Product::whereIn('id', $wishlist)->get();

        return view('frontEnd.products.wishlist', compact('products'));
    }
}
