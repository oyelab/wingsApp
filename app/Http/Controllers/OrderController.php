<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showCart()
    {
        // Retrieve the cart from the session
		$cart = session()->get('cart', []);
		
		// Pass the cart data to the view
		return view('frontEnd.orders.cart', compact('cart'));
    }
    
	public function addCart(Request $request)
    {
		// return $request;
       // Get product details
	   $product = Product::find($request->input('product'));

	//    return $product;

	   if (!$product) {
		   return redirect()->back()->with('error', 'Product not found');
	   }

	   // Retrieve existing cart session or create a new one
	   $cart = session()->get('cart', []);



	   // Add the product to the cart (you can include quantity, price, etc.)
	   if (isset($cart[$product->id])) {
		   // If the product is already in the cart, increase the quantity
		   $cart[$product->id]['quantity']++;
	   } else {
		   // Add the new product to the cart
		   $cart[$product->id] = [
			   'title' => $product->title,
			   'price' => $product->price,
			   'quantity' => 1,
			   'image' => $product->image // Assuming first_image is available
		   ];
	   }

	//    return $cart;

	   // Save the updated cart in the session
	   session()->put('cart', $cart);

	   // Redirect to the cart page
	   return redirect()->route('checkout')->with('success', 'Product added to cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontEnd.orders.cart');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
	{
		// Get the cart from the session
		$cart = session()->get('cart');

		if(!$cart || empty($cart)) {
			return redirect()->back()->with('error', 'Your cart is empty!');
		}

		// return $cart;

		// Create a new order (assuming the customer is authenticated)
		$order = new Order();
		$order->customer_id = auth()->id();
		$order->total_price = array_sum(array_column($cart, 'price')); // Total order price
		$order->save();

		// Add each product to the order
		foreach ($cart as $productId => $details) {
			$order->products()->attach($productId, [
				'quantity' => $details['quantity'],
				'price' => $details['price'],
			]);
		}

		// Clear the cart after order is placed
		session()->forget('cart');

		return redirect()->route('order.success')->with('success', 'Order placed successfully!');
	}


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
