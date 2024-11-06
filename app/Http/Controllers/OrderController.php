<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Quantity;
use Illuminate\Http\Request;
use Session;


class OrderController extends Controller
{
	public function addToCart(Request $request)
	{
		$productId = $request->input('product_id');
		$sizeId = $request->input('size_id');
		$quantityToAdd = $request->input('quantity', 1); // Default to 1 if quantity is not specified
	
		// Get the product along with its quantities
		$product = Product::with('quantities')->find($productId);
	
		// Find the available quantity for the specific size
		$availableQuantity = $product->quantities->where('size_id', $sizeId)->first()->quantity ?? 0;
	
		// Check if the requested quantity exceeds available quantity
		if ($quantityToAdd > $availableQuantity) {
			return response()->json(['message' => 'Requested quantity exceeds available quantity.'], 400);
		}
	
		// Get existing cart from session or initialize a new one
		$cart = Session::get('cart', []);
	
		// Check if the product with the selected size already exists in the cart
		$found = false;
		foreach ($cart as &$item) {
			if ($item['product_id'] == $productId && $item['size_id'] == $sizeId) {
				// Increment quantity, but check against available quantity
				if ($item['quantity'] + $quantityToAdd > $availableQuantity) {
					return response()->json(['message' => 'Requested quantity exceeds available quantity.'], 400);
				}
				$item['quantity'] += $quantityToAdd; // Increment quantity
				$found = true;
				break;
			}
		}
	
		// If product with selected size is not in cart, add it as a new item
		if (!$found) {
			$cart[] = [
				'product_id' => $productId,
				'size_id' => $sizeId,
				'quantity' => $quantityToAdd,
			];
		}
	
		// Update the session with the new cart array
		Session::put('cart', $cart);
	
		return response()->json(['message' => 'Product added to cart successfully']);
	}
	


	public function showCart()
	{
		// Get cart items from session or initialize an empty array
		$cartItems = collect(Session::get('cart', []));

		// Load additional product and size details for each item
		$cartItems = $cartItems->map(function($item) {
			$product = Product::with('categories')->find($item['product_id']);
			$size = Size::find($item['size_id']);

			// Ensure product and size exist
			if ($product && $size) {
				return array_merge($item, [
					'title' => $product->title,
					'price' => $product->price,
					'sale' => $product->sale,
					'salePrice' => $product->offer_price,
					'categories' => $product->categories->pluck('title')->implode(', '),
					'size_name' => $size->name,
				]);
			}
			return $item;
		});

		// Check if the cart is empty
		if ($cartItems->isEmpty()) { // Change this line
			return redirect('/')->with('alert', [
				'type' => 'warning', // or 'success', 'danger', etc.
				'message' => 'Your cart is empty. Please add some products to continue shopping.'
			]);
		}

		return view('frontEnd.orders.cart', compact('cartItems'));
	}




	public function updateQuantity($index, Request $request)
	{
		$cart = Session::get('cart', []);

		// Check if the item exists in the cart
		if (isset($cart[$index])) {
			// Get the product ID and size ID from the cart item
			$productId = $cart[$index]['product_id'];
			$sizeId = $cart[$index]['size_id'];

			// Get the product along with its quantities
			$product = Product::with('quantities')->find($productId);

			// Find the available quantity for the specific size
			$availableQuantity = $product->quantities->where('size_id', $sizeId)->first()->quantity ?? 0;

			// Update the quantity
			$cart[$index]['quantity'] += $request->amount;

			// Check if the new quantity exceeds available quantity or is less than 1
			if ($cart[$index]['quantity'] < 1) {
				$cart[$index]['quantity'] = 1; // Prevents quantity from going below 1
			} elseif ($cart[$index]['quantity'] > $availableQuantity) {
				return response()->json(['message' => 'Requested quantity exceeds available quantity.'], 400);
			}

			// Update the cart in the session
			Session::put('cart', $cart);
		}

		return response()->json(['success' => true]);
	}


	public function removeFromCart($index)
	{
		$cart = Session::get('cart', []);
		if (isset($cart[$index])) {
			unset($cart[$index]);
			Session::put('cart', array_values($cart)); // Re-index array
		}
		return response()->json(['success' => true]);
	}


	public function orderPlaced(Order $order)
	{
		if (session('order_ref')) {
			$orderDetails = $order->getOrderDetails()->calculateTotals();
	
			// Check if the user is logged in or exists in the database
			$showModal = !auth()->check() && !User::where('email', $order->email)->exists();
	
			// session()->forget('order_ref');
	
			return view('frontEnd.orders.success', [
				'order_details' => $orderDetails,
				'order_items' => $orderDetails->getOrderItems(),
				'showModal' => $showModal,
			]);
		}
	
		return redirect()->route('index')->with('error', 'Access denied. Please login or register to find your existing order!');
	}
}
	

