<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use App\Models\Quantity;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
	public function index()
	{
		// Initialize the cart session
		$cart = session('cart', []);

		// Fetch products and sizes from the cart
		$cartItems = collect($cart)->map(function($item) {
			$product = Product::find($item['product_id']);
			$size = Size::find($item['size_id']);
			$availableQuantity = $size->quantities()->where('product_id', $product->id)->first()->quantity; // Adjust this as per your model relationship
		
			return [
				'product' => $product,
				'size' => $size,
				'quantity' => $item['quantity'],
				'unitPrice' => $product->price,
				'totalPrice' => $product->price * $item['quantity'], // Keep it simple here
				'availableQuantity' => $availableQuantity // Ensure this is set
			];
		});


		// Ensure that the grand total and quantity counting are correct
		$grandTotal = $cartItems->sum('totalPrice');
	
		// Total unique products count (regardless of quantity)
		$totalItems = $cartItems->count();
	
		// Pass cart items and grand total to the view
		return view('frontEnd.orders.cart', compact('cartItems', 'grandTotal', 'totalItems'));
	}


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


    public function update(Request $request)
	{
		// Validate the input
		$cartData = $request->input('cart', []);


		// Optionally, you can validate the data here
		// e.g., check for required fields, numeric types, etc.

		// Update the cart data in the session
		session(['cart' => $cartData]);

		// Redirect to the checkout page
		return redirect()->route('checkout');
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

	
	public function showCheckout()
    {
        // Retrieve cart items from the session
        $cartItems = session('cart', []);
        
        // Initialize an array to hold product details and the grand total
        $products = [];
        $grandTotal = 0;


        // Fetch product details for each cart item and calculate total
        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);

            // Add product details to the products array if found
            if ($product) {
                $totalPrice = $product->price * $item['quantity'];
                $grandTotal += $totalPrice; // Accumulate grand total

                $products[] = [
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'size' => $item['size_id'], // Assuming you also have size details
                    'totalPrice' => $totalPrice // Store total price for this item
                ];
            }
        }

		

        // Pass the cart items, product details, and grand total to the view
        return view('frontEnd.orders.checkout', [
            'cartItems' => $cartItems,
            'products' => $products,
            'grandTotal' => $grandTotal, // Pass the grand total
        ]);
    }

	public function process(Request $request)
	{
		// Validate incoming request
		$validatedData = $request->validate([
			'name' => 'required|string|max:255',
			'mobile' => 'required|string|max:20',
			'address' => 'required|string|max:255',
			'delivery_type' => 'required|in:inside,outside',
			'payment_option' => 'required|in:delivery_fee,full',
		]);

		// Retrieve cart items from session or wherever they're stored
		$cartItems = session('cart', []);
		
		// Calculate total product fee
		$grandTotal = 0;
		foreach ($cartItems as $cartItem) {
			$grandTotal += $cartItem['totalPrice']; // Assuming totalPrice is already calculated
		}

		// Calculate delivery fee based on delivery type
		$deliveryFee = ($validatedData['delivery_type'] === 'inside') ? 0 : 100; // Adjust fee as necessary

		// Calculate final total amount based on payment option
		$totalAmount = ($validatedData['payment_option'] === 'full') ? $grandTotal + $deliveryFee : $deliveryFee;

		// Here you can handle your payment processing logic
		// For example, redirecting to a payment gateway with the total amount
		// Below is a placeholder redirect; replace it with your actual payment gateway logic

		// Example redirect to payment gateway
		return redirect()->route('payment.gateway', [
			'amount' => $totalAmount,
			'name' => $validatedData['name'],
			'mobile' => $validatedData['mobile'],
			'address' => $validatedData['address'],
			'cartItems' => $cartItems,
		]);
	}

	

}
	

