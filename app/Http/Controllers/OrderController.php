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
		// Check for the order_ref session variable
		$orderRef = session('order_ref');

		if ($orderRef) {
			// Retrieve order details with related transactions using Eloquent
			$order_details = Order::with('transactions') // Replace 'transactions' with the actual relationship name
			->where('ref', $order->ref)
			->first();

			// Retrieve unique products related to the order and prepare image paths
			$order_items = $order_details->products->unique('id')->map(function($product) {
				$imagePath = 'images/products/' . json_decode($product->images)[0] ?? 'default.jpg'; // Get the first image or default
		
				// Get size name via the pivot relationship
				$sizeName = $product->sizes->firstWhere('id', $product->pivot->size_id)->name ?? 'N/A';
		
				return [
					'id' => $product->id,
					'title' => $product->title,
					'price' => $product->price,
					'sale' => $product->sale ? $product->price * (1 - $product->sale / 100) : $product->price,
					'categories' => $product->categories->pluck('title')->unique()->implode(', '), // Unique categories
					'size' => $sizeName, // Assuming 'size_id' is in the pivot
					'quantity' => $product->pivot->quantity, // Assuming 'quantity' is in the pivot
					'imagePath' => $imagePath,
				];
			});

			$order_details->tran_date = $order_details->transactions->first()->tran_date;
			
			// Initialize total discount and product total
			$total_discount = 0;
			$product_total = 0;

			// Iterate through each product in the order
			foreach ($order_details->products as $product) {
				// Get the quantity from the pivot table
				$quantity = $product->pivot->quantity;
				
				// Get the product price
				$product_price = $product->price; // Assuming 'price' is the product's price
				
				// Calculate the total amount for this product without discount
				$product_total += $product_price * $quantity;

				// Get the discount percentage for the product
				$discount_percentage = $product->sale; // Assuming 'sale' is the discount percentage

				// Calculate the discount for this product if it has a discount
				if ($discount_percentage > 0) {
					// Calculate the discount amount
					$discount_amount = ($product_price * $discount_percentage / 100) * $quantity;

					// Add to total discount
					$total_discount += $discount_amount;
				}
			}

			// return $total_discount;
			$order_details->subtotal = $product_total;
			$order_details->discount = $total_discount;
			$order_details->shipping_charge = $order_details->transactions->first()->shipping_charge;

			$order_details->order_total = $product_total - $total_discount + $order_details->shipping_charge;
			$order_details->paid = $order_details->transactions->first()->amount;
			$order_details->unpaid_amount = $order_details->order_total - $order_details->paid;

			// Check if the user is signed up or exists in the database
			$userSignedUp = auth()->check(); // Checks if the user is logged in
			$userExists = User::where('email', $order->email)->exists();

			// Pass a single variable to check both conditions
			$showModal = !$userSignedUp && !$userExists;

		
			// Pass order details and products to the view
			return view('frontEnd.orders.success', [
				'order_details' => $order_details,
				'order_items' => $order_items,
				'showModal' => $showModal,
			]);
		}
		
		// After the view is returned
		session()->flush(); // Clear all session data

	}
}
	

