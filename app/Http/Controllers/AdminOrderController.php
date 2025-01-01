<?php

namespace App\Http\Controllers;

use App\Models\AdminOrder;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Services\SSLCommerzRefundService;



class AdminOrderController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('role'); // Only allow role 1 users
    }

	
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		// Retrieve only orders where payment_status is 3 (pending refund) or 4 (refund completed)
		$orders = Order::whereHas('transactions', function($query) {
			$query->whereIn('payment_status', [0, 1]);
		})->get();

		// Loop through the orders and calculate totals
		foreach ($orders as $order) {
			// Call the calculateTotals() method to populate order totals
			$order->calculateTotals();
		}
		
		// return $orders;

		return view('backEnd.orders.index', [
			'orders' => $orders,
		]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontEnd.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show($orderId)
    {
		$order = Order::with(['products' => function ($query) {
			$query->withPivot('size_id', 'quantity');
		}])->findOrFail($orderId);

		$sizes = Size::all(); // Get all available sizes
	
		return response()->json(['order' => $order, 'sizes' => $sizes]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($orderId)
	{
		// Fetch the order with related transactions and products
		$order = Order::with(['transactions', 'products' => function ($query) {
			$query->withPivot('size_id', 'quantity'); // Include pivot data
		}])->findOrFail($orderId);

		$delivery = Delivery::where('order_id', $orderId)->first();

		// Organize quantities specific to this order by product and size
		$productQuantities = [];
		$totalQuantity = 0; // Variable to store the total quantity

		foreach ($order->products as $product) {
			$productId = $product->id;
			$sizeId = $product->pivot->size_id;
			$quantity = $product->pivot->quantity;

			// Initialize array for product ID if not already set
			if (!isset($productQuantities[$productId])) {
				$productQuantities[$productId] = [];
			}

			// Store the quantity per size
			$productQuantities[$productId][$sizeId] = $quantity;

			// Accumulate the total quantity
			$totalQuantity += $quantity;
		}

		// Access the first transaction related to the order (assuming it's a single transaction per order)
		$transaction = $order->transactions->first();

		// Calculate the unpaid amount if the transaction exists
		if ($transaction) {
			$transaction->unpaid = ($transaction->order_total + $transaction->shipping_charge) - $transaction->amount;
		}

		// return $totalQuantity;

		return view('backEnd.orders.delivery', [
			'order' => $order->calculateTotals(),
			'totalQuantity' => $totalQuantity, // Pass the total quantity to the view
			'transaction' => $transaction, // Pass the total quantity to the view
			'delivery' => $delivery, // Pass the total quantity to the view
		]);
	}


    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, $orderId)
	{
		// Validate the incoming status
		$request->validate([
			'status' => 'required|integer',
		]);
	
		// Fetch the order or fail with 404
		$order = Order::findOrFail($orderId);
	
		// Update the order status (this happens irrespective of whether it's a refund or not)
		$order->status = $request->status;
	
		// Handle refund initiation if the status is "Refunded" (e.g., status = 4)
		if ($request->status == 4) {
			$refundService = new SSLCommerzRefundService();
			$transaction = $order->transactions()->where('status', 'VALID')->first();
			$refundTransaction = $order->transactions()->where('payment_status', 3)->first();
	
			// Ensure transaction and refund details are available
			if (!$transaction || empty($transaction->bank_tran_id) || !$refundTransaction || empty($refundTransaction->error)) {
				return response()->json([
					'success' => false,
					'message' => 'Transaction or refund details are missing or invalid.',
				], 400);
			}
	
			// Initiate refund
			$refundResponse = $refundService->initiateRefund(
				$transaction->bank_tran_id,
				$transaction->amount,
				$refundTransaction->error,
				$order->ref // Optional parameter
			);
	
			// Check refund response and handle accordingly
			if ($refundResponse['status'] !== 'success') {
				// If refund fails, set the order status to "Failed"
				$order->status = 5; // Set status to "Failed"
				$order->save(); // Save the updated order
	
				return response()->json([
					'success' => false,
					'message' => 'Refund initiation failed.',
					'error' => $refundResponse['error'] ?? 'Unknown error occurred.',
					'order' => $order,
					'refund_response' => $refundResponse // Include the full refund response
				], 400);
			}
	
			// If refund is successful, update the refund transaction and set order status as refunded
			$order->save(); // Save order with updated status (Refunded)
	
			// Update refund transaction's payment_status to 4 (Refunded)
			if ($refundTransaction) {
				$refundTransaction->payment_status = 4; // Mark as refunded
				$refundTransaction->save(); // Save the updated refund transaction model
			}
		} else {
			// If the status is not 4 (Refunded), just save the order status
			$order->save();
		}
	
		// Return success response with updated order details and refund response if applicable
		return response()->json([
			'success' => true,
			'message' => 'Order status updated successfully.',
			'order' => $order, // Include updated order
			'refund_response' => isset($refundResponse) ? $refundResponse : null, // Include refund response only if refund was initiated
		]);
	}
	




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminOrder $adminOrder)
    {
        //
    }

	// In your controller
	

	public function updateOrderProduct(Request $request)
	{
		// return $request;
		// Validate incoming request
		$request->validate([
			'product_id' => 'required|integer',
			'size_id' => 'required|integer',
			'quantity' => 'required|integer|min:0',
		]);

		// Find the order you want to update (assuming you have an order_id from the session or request)
		$orderId = session('order_id'); // Adjust based on how you handle orders

		// Update the quantity in the pivot table
		$order = Order::find($orderId);
		$order->products()->updateExistingPivot(
			$request->product_id,
			['size_id' => $request->size_id, 'quantity' => $request->quantity]
		);

		return response()->json(['message' => 'Order product updated successfully.']);
	}

	// public function deleteOrderProduct($productId, $sizeId)
	// {
	// 	// Find the order you want to delete from (assuming you have an order_id from the session or request)
	// 	$orderId = session('order_id'); // Adjust based on how you handle orders

	// 	// Remove the product from the order
	// 	$order = Order::find($orderId);
	// 	$order->products()->detach($productId, ['size_id' => $sizeId]);

	// 	return response()->json(['message' => 'Order product deleted successfully.']);
	// }



}
