<?php

namespace App\Http\Controllers;

use App\Models\AdminOrder;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Size;



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
		$orders = Order::with([
			'transactions' => function ($query) {
				$query->where('status', 'VALID');
			},
			'products',
			'delivery'
		])
		->latest()
		->get();
		
		// return $orders;

		// Iterate over each order to perform the calculations for each transaction
		foreach ($orders as $order) {
			foreach ($order->transactions as $transaction) {
				// Calculate the unpaid amount and add it to each transaction instance
				$transaction->unpaid = ($transaction->order_total + $transaction->shipping_charge) - $transaction->amount;
			}
		}

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
			'order' => $order,
			'totalQuantity' => $totalQuantity, // Pass the total quantity to the view
			'transaction' => $transaction, // Pass the total quantity to the view
			'delivery' => $delivery, // Pass the total quantity to the view
		]);
	}


    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request)
	{
		dd($request);

		return $request;
		// $productsData = $request->input('products');
		// return $productsData;



		// Find the order by ID
		$order = Order::findOrFail($orderId);

		return $order;

		// Update order status
		$order->status = $request->status;
		$order->save();

		return response()->json(['success' => true, 'order' => $order]);
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
		return $request;
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

	public function deleteOrderProduct($productId, $sizeId)
	{
		// Find the order you want to delete from (assuming you have an order_id from the session or request)
		$orderId = session('order_id'); // Adjust based on how you handle orders

		// Remove the product from the order
		$order = Order::find($orderId);
		$order->products()->detach($productId, ['size_id' => $sizeId]);

		return response()->json(['message' => 'Order product deleted successfully.']);
	}



}
