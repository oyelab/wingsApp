<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
	public function add(Request $request)
	{
		 // Retrieve session cart or initialize an empty array
		 $cart = session()->get('cart', []);

		 // Create a unique key for the product-size combination
		 $productId = $request->input('product_id');
		 $sizeId = $request->input('size_id');
		 $cartKey = $productId . '_' . $sizeId;
	 
		 // Check if the product-size combination already exists in the cart
		 if (array_key_exists($cartKey, $cart)) {
			 return redirect()->back()->with('error', 'This size of the product is already in your cart.');
		 }
	 
		 // Add the product-size combination to the cart with the product and size details
		 $cart[$cartKey] = [
			 'product_id' => $productId,
			 'size_id' => $sizeId,
			 'quantity' => 1, // Default quantity to 1 for now
		 ];
	 
		 // Update the cart in the session
		 session()->put('cart', $cart);
	 
		 // Redirect back with success message
		 return redirect()->back()->with('success', 'Product added to the cart.');
	}

	public function index()
	{
		// Initialize the cart session
		$cart = session('cart', []);

		// Fetch products and sizes from the cart
		$cartItems = collect($cart)->map(function($item) {
			$product = Product::find($item['product_id']);
			$size = Size::find($item['size_id']);
			
			return [
				'product' => $product,
				'size' => $size,
				'quantity' => $item['quantity'],
				'unitPrice' => $product->price,
				'totalPrice' => $product->price * $item['quantity'],
			];
		});

		// Ensure that the grand total and quantity counting are correct
		$grandTotal = $cartItems->sum('totalPrice');
		
		// Total unique products count (regardless of quantity)
		$totalItems = $cartItems->count();
	
		// Pass cart items and grand total to the view
		return view('frontEnd.orders.cart', compact('cartItems', 'grandTotal', 'totalItems'));
	}

    public function update(Request $request)
	{
		// Retrieve the cart from session
		$cart = session()->get('cart', []);

		// Loop through the updated cart items
		foreach ($request->cart as $key => $item) {
			// Update the quantity for each item
			if (isset($cart[$key])) {
				$cart[$key]['quantity'] = $item['quantity'];
			}
		}

		// Update the session with the modified cart
		session()->put('cart', $cart);

		return redirect()->back()->with('success', 'Cart updated successfully.');
	}

	public function remove($key)
	{
		// Retrieve the cart from session
		$cart = session()->get('cart', []);

		// Remove the item from the cart
		if (isset($cart[$key])) {
			unset($cart[$key]);
		}

		// Update the session with the modified cart
		session()->put('cart', $cart);

		return redirect()->back()->with('success', 'Item removed from cart.');
	}

}
	

