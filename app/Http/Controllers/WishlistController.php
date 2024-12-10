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


    // This method displays the wishlist page
    public function index()
    {
        // Fetch all products in the wishlist based on stored IDs in session
        $wishlist = session()->get('wishlist', []);
		// Fetch products with their associated categories
		$products = Product::with('categories')->whereIn('id', $wishlist)->get();

		$categorySlug = null;
		$subcategorySlug = null;

		foreach ($products as $product) {
			if ($product->categories->isNotEmpty()) {
				// Assuming there's only one category per product in this example
				$pivot = $product->categories[0]->pivot;

				$category = \App\Models\Category::find($pivot->category_id);
				$subcategory = \App\Models\Category::find($pivot->subcategory_id);

				$categorySlug = $category ? $category->slug : null;
				$subcategorySlug = $subcategory ? $subcategory->slug : null;

			}
		}

        return view('frontEnd.products.wishlist', compact('products'));
    }
}
