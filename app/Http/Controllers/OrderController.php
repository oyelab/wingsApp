<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	// Add product to cart
	public function add(Request $request)
	{
		$productId = $request->input('product_id');
		$sizeId = $request->input('size');

		// Get the current cart from the session or initialize an empty array
		$cart = session()->get('cart', []);

		// Generate a unique key for the cart item based on product and size
		$cartKey = $productId . '_' . $sizeId;

		// Check if the product with the selected size already exists in the cart
		if (isset($cart[$cartKey])) {
			// If it exists, update the quantity
			$cart[$cartKey]['quantity'] += 1;
		} else {
			// If it doesn't exist, add it as a new entry
			$cart[$cartKey] = [
				'product_id' => $productId,
				'size_id' => $sizeId,
				'quantity' => 1
			];
		}

		// Save the updated cart back to the session
		session()->put('cart', $cart);

		return redirect()->back()->with('success', 'Product added to cart successfully.');
	}
	// Show the cart page
	public function update(Request $request)
	{
		$cart = session()->get('cart', []);
		
		foreach ($request->quantities as $itemId => $quantity) {
			if ($quantity <= 0) {
				unset($cart[$itemId]); // Remove item if quantity is 0
			} else {
				$cart[$itemId]['quantity'] = $quantity; // Update quantity
			}
		}

		session()->put('cart', $cart);
		return redirect()->route('cart.index');
	}

	public function index()
	{
		$cart = session()->get('cart', []);
		$cartDetails = [];

		foreach ($cart as $itemId => $item) {
			// Fetch the product details from the database
			$product = Product::find($itemId);
			if ($product) {
				$cartDetails[] = [
					'product_title' => $item['title'],
					'size_name' => $item['size_name'],
					'price' => $item['price'],
					'quantity' => $item['quantity'],
					'total' => $item['price'] * $item['quantity'],
				];
			}
		}
		return $cartDetails;

		return view('cart.index', [
			'cart' => $cartDetails,
		]);
	}

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]); // Remove the item
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    private function calculateTotalPrice($cart)
    {
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return $totalPrice;
    }
}
	

