<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Size;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;





class OrderController extends Controller
{

	public function generateInvoice(Order $order)
	{	
		// Perform necessary calculations
		$order->getOrderDetails()->calculateTotals();
		$items = $order->getOrderItems();
	
		// Render the Blade template with the necessary data
		$html = View::make('frontEnd.orders.invoice', compact('order', 'items'))->render();
	
		// Configure mPDF
		$mpdf = new Mpdf([
			'mode' => 'utf-8',
			'format' => 'A4',
		]);
	
		// Load the HTML into mPDF and generate the PDF
		$mpdf->WriteHTML($html);
	
		// Output the PDF
		return $mpdf->Output($order->ref . '.pdf', 'D'); // 'I' displays in-browser, 'D' forces download
	}
	

	public function invoice(Request $request)
	{
		// Validate request data
		$request->validate([
			'order_id' => 'required|exists:orders,id',
		]);
	
		// Retrieve the order with transactions
		$order = Order::with('transactions')->findOrFail($request->order_id);
	
		// Prepare data for the invoice
		$invoiceData = [
			'order' => $order,  // This contains the order details
			'transactions' => $order->transactions,
		];
	
		// Dump the order and invoiceData to check before returning
		dd($order, $invoiceData);
	
		// Return the PDF and the order data as a JSON response
		return response()->json([
			'order' => $order,  // Sending the order data to JavaScript
			'invoiceData' => $invoiceData,
		]);
	}
	

	
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
		$found = false;

		// Check if the product with the selected size already exists in the cart
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

		// If product with selected size is not in cart, add it as a new item and destroy voucher session
		if (!$found) {
			// Destroy the voucher session when a new product is added
			Session::forget(['voucher_success', 'applied_voucher', 'voucher']);

			// Add price and salePrice to the cart
			$cart[] = [
				'product_id' => $productId,
				'size_id' => $sizeId,
				'quantity' => $quantityToAdd,
				'price' => $product->price, // Regular price
				'salePrice' => $product->offer_price ?? null, // Sale price (if applicable)
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
		// return $cartItems;

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
					'imagePath' => $product->thumbnail,
				]);
			}
			return $item;
		});

				// return $cartItems;


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
	
		if (isset($cart[$index])) {
			$productId = $cart[$index]['product_id'];
			$sizeId = $cart[$index]['size_id'];
	
			$product = Product::with('quantities')->find($productId);
			$availableQuantity = $product->quantities->where('size_id', $sizeId)->first()->quantity ?? 0;
	
			$newQuantity = $cart[$index]['quantity'] + $request->amount;
	
			if ($newQuantity < 1) {
				$newQuantity = 1;
			} elseif ($newQuantity > $availableQuantity) {
				return response()->json(['message' => 'Requested quantity exceeds available quantity.'], 400);
			}
	
			if ($newQuantity < $cart[$index]['quantity']) {
				Session::forget(['voucher_success', 'applied_voucher', 'voucher']);
			}
	
			$cart[$index]['quantity'] = $newQuantity;
			Session::put('cart', $cart);
	
			// Re-fetch prices from the database to ensure accurate calculations
			$subtotal = 0;
			$totalDiscount = 0;
	
			foreach ($cart as $item) {
				$product = Product::find($item['product_id']);
				$regularPrice = $product->price; // Get regular price from the database
				$salePrice = $product->offer_price ?? $regularPrice; // Get sale price if applicable, otherwise use regular price
	
				$regularPriceTotal = $regularPrice * $item['quantity'];
				$discountedPriceTotal = $salePrice * $item['quantity'];
	
				$subtotal += $regularPriceTotal;
				$totalDiscount += ($regularPriceTotal - $discountedPriceTotal);
			}
	
			$total = $subtotal - $totalDiscount;
	
			return response()->json([
				'success' => true,
				'newQuantity' => $newQuantity,
				'availableQuantity' => $availableQuantity,
				'subtotal' => number_format($subtotal, 2),
				'totalDiscount' => number_format($totalDiscount, 2),
				'total' => number_format($total, 2)
			]);
		}
	
		return response()->json(['message' => 'Item not found in cart.'], 400);
	}
	


	private function calculateCartSummary($cart)
	{
		$subtotal = 0;
		$totalDiscount = 0;
		$itemCount = 0;

		foreach ($cart as $item) {
			$regularPrice = $item['price'] ?? 0;
			$salePrice = $item['salePrice'] ?? $regularPrice;
			$quantity = $item['quantity'];

			$regularPriceTotal = $regularPrice * $quantity;
			$discountedPriceTotal = $salePrice * $quantity;

			$subtotal += $regularPriceTotal;
			$totalDiscount += ($regularPriceTotal - $discountedPriceTotal);
			$itemCount += $quantity;
		}

		return [
			'subtotal' => $subtotal,
			'totalDiscount' => $totalDiscount,
			'totalAmount' => $subtotal - $totalDiscount,
			'itemCount' => $itemCount
		];
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
		// return $order;
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

	public function orderFailed(Request $request, Order $order)
	{
		if (session('order_ref')) {
			$orderDetails = $order->calculateTotals();
			return $orderDetails->transactions->pluck('error');
		}

		return redirect()->route('index')->with('error', 'Access denied. Please login or register to find your existing order!');

	}
}
	

