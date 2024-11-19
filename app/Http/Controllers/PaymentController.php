<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quantity;
use App\Models\Size;
use App\Models\Voucher;
use App\Models\Transaction;
use App\Models\Category;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Str;
use Session;



class PaymentController extends Controller
{
	public function showCheckout()
	{
		// Get cart items from session
		$cartItems = collect(Session::get('cart', []));
		// return $cartItems;
		
		// Load additional product and size details for each item
		$cartItems = $cartItems->map(function($item) {
			$product = Product::with('categories')->find($item['product_id']);
			$size = Size::find($item['size_id']);

			// Ensure product and size exist
			if ($product && $size) {
				// Use salePrice if available, otherwise use regular price
				$price = $product->salePrice ?: $product->price;

				return array_merge($item, [
					'title' => $product->title,
					'price' => $product->price,
					'sale' => $product->sale,
					'salePrice' => $product->offer_price,
					'categories' => $product->categories->pluck('title')->implode(', '),
					'size_name' => $size->name,
					'total_price' => $price * $item['quantity'], // Calculate total price based on salePrice or price
				]);
			}
			return $item;
		});

		// Check if the cart is empty
		if ($cartItems->isEmpty()) {
			return redirect('/')->with('alert', [
				'type' => 'warning',
				'message' => 'Your cart is empty. Please add some products to continue shopping.'
			]);
		}

		$orderTotal = $cartItems->sum('total_price');


		$voucherDiscount = session('voucher', 0); // Default to 0 if no voucher is applied
		// return $voucherDiscount;

		// Step 1: Calculate the discount amount
		// $voucherDiscount = round(($orderTotal * $voucher) / 100, 2);

		// // Step 2: Format the value for display (optional, for presentation)
		// $voucherDiscountAmount = number_format($voucherDiscount, 2, '.', '');

		// return $voucherDiscountAmount;


		return view('frontEnd.orders.checkout', compact('cartItems', 'voucherDiscount'));
	}


	public function processCheckout(Request $request)
    {
		// return $request;
		$tran_id = 'ws' . substr(Str::uuid()->toString(), 0, 8);

        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
			'address' => 'required|string|min:10|max:255',
            'payment_method' => 'required|in:COD,Full Payment', // Ensure it matches your form values
			'terms' => 'accepted',
			'recipient_city' => 'required|numeric',
			'recipient_zone' => 'required|numeric',
			'recipient_area' => 'nullable|numeric',
        ]);

		// Calculate delivery charge based on location
    	$shipping_charge = $request->input('shipping_charge');
	
		// Calculate the base fair (total amount before discount)
		$subTotal = collect($request->products)->sum(function ($product) {
			$productDetails = Product::find($product['id']);
			return (float)$productDetails->price * (int)$product['quantity'];
		});

		$subTotal = number_format($subTotal, 2, '.', ''); // Ensures 2 decimal places

		// return $subTotal;

		$voucher = $request->input('voucher');
		// return $voucher;

		// Calculate total discount based on the `sale` field in the products table
		$discount_amount = collect($request->products)->sum(function ($productData) {
			// Find the product by ID
			$product = Product::find($productData['id']);
			
			// Check if the product exists and call the calculateDiscount method
			return $product ? $product->calculateDiscount($productData['quantity']) : 0;
		});

		// Format the discount amount, but only if it's greater than 0
		$discount_amount = $discount_amount > 0 ? number_format($discount_amount, 2, '.', '') : null;


		// Calculate the subtotal after discount
		$order_total = $subTotal - $discount_amount - $voucher; // Calculate subtotal

		// return $order_total;  

		$order_total = number_format($order_total, 2, '.', '');

		// Define the payment method (you will set this based on customer selection)
		$payment_method = $validated['payment_method']; // 'COD' or 'Full Payment'

		// Set total based on the payment method
		$total = ($payment_method === 'COD') ? $shipping_charge : ($order_total + $shipping_charge);

		// return $total;

		$userId = auth()->check() ? auth()->user()->id : null;

		// Create the order
		$order = Order::create([
			'ref' => $tran_id,
			'user_id' => $userId, // Set customer_id or keep it null
			'name' => $validated['name'],
			'email' => $validated['email'],
			'phone' => $validated['phone'],
			'address' => $validated['address'],
			'terms' => true, // You can directly set it as true since it's validated
			'status' => 0, // Set order status as Pending initially
		]);

		// return $order;


		// Create the transaction data
		$transaction_data = [
			'ref' => $tran_id,
			'order_id' => $order->id,
			'subtotal' => $subTotal,
			'shipping_charge' => $shipping_charge, // Always store shipping charge
            'order_discount' => $discount_amount,
            'voucher' => $voucher,
			'order_total' => $order_total,
			'payment_status' => $payment_method === 'Full Payment', // true if Full Payment, false if COD
		];

		// return $transaction_data;

		// Store the transaction data
		$order->transactions()->create($transaction_data);

	
		foreach ($request->products as $product) {
			$productId = $product['id'];
			$sizeId = $product['size_id'];
			$quantityToOrder = $product['quantity'];
		
			// Fetch the current stock level for the product and size
			$currentStock = Quantity::where('product_id', $productId)
				->where('size_id', $sizeId)
				->value('quantity');
		
			// Check if the requested quantity is available
			if ($currentStock < $quantityToOrder) {
				// If not enough stock, handle the error (e.g., return an error response)
				return redirect()->back()->withErrors([
					'stock' => "The quantity for product ID $productId and size ID $sizeId is insufficient. Only $currentStock items are available.",
				]);
			}
		
			// If sufficient stock, proceed to attach the product to the order
			$order->products()->attach($productId, [
				'size_id' => $sizeId,
				'quantity' => $quantityToOrder,
			]);
		
			// Decrement quantity in the quantities table
			Quantity::where('product_id', $productId)
				->where('size_id', $sizeId)
				->decrement('quantity', $quantityToOrder);
		}
		
		// Prepare delivery data
		$delivery_data = [
			'order_id' => $order->id,
			'order_ref' => $tran_id,
			'delivery_fee' => $shipping_charge,
			'recipient_city' => $validated['recipient_city'],
			'recipient_zone' => $validated['recipient_zone'],
			'recipient_area' => $validated['recipient_area'],
			'order_status' => "Pending", // Initial status, set as needed (e.g., Pending)
		];

		// return $delivery_data;

		// Save delivery information
		$order->delivery()->create($delivery_data); // Using the relationship to create the delivery

		// return $order;

		$productNames = collect();
		$productCategories = collect();

		foreach ($order->products as $product) {
			// Add product name and category titles to the collections, ensuring unique values
			$productNames->push($product->title); 
			$productCategories = $productCategories->merge($product->categories->pluck('title')); 
		}

		// Convert to unique, comma-separated strings
		$product_names = $productNames->unique()->implode(', ');
		$product_categories = $productCategories->unique()->implode(', ');
       

        // Prepare $post_data using the retrieved product information
        $post_data = [
            'tran_id' => $tran_id,
            'product_amount' => $order_total,
            'total_amount' => $total,
            'currency' => "BDT",
            'cus_name' => $validated['name'],
            'cus_email' => $validated['email'],
            'cus_phone' => $validated['phone'],
            'cus_add1' => $validated['address'],
            'cus_country' => "Bangladesh",
            'shipping_method' => "NO",
            'product_name' => $product_names, // Comma-separated product names
            'product_category' => $product_categories, // Comma-separated category names
            'product_profile' => "general", // Assuming it's still validated
        ];

		// return $post_data;

        $sslc = new SslCommerzNotification();
		
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

	public function paymentSuccess(Request $request)
	{
		
		// return $request;

		$sslc = new SslCommerzNotification();
	
		// Retrieve order details with related transactions using Eloquent
		$order_details = Order::with('transactions') // Replace 'transactions' with the actual relationship name
			->where('ref', $request->tran_id)
			->first();
	
		// Initialize a message variable
		$message = '';
	
		// Check if the order exists
		if ($order_details) {
			// Check the order status
			if ($order_details->status == 0) { // 0 means 'Pending'
				$validation = $sslc->orderValidate($request->all(), $request->tran_id, $request->amount);
	
				if ($validation) {
					// Check for existing transaction
					$existingTransaction = $order_details->transactions()->where('ref', $request->tran_id)->first();
	
					// Prepare transaction data
					$transaction_data = [
						'ref' => $request->tran_id,
						'order_id' => $order_details->id,
						'val_id' => $request->val_id,
						'amount' => $request->amount,
						'card_type' => $request->card_type,
						'store_amount' => $request->store_amount,
						'card_no' => $request->card_no,
						'bank_tran_id' => $request->bank_tran_id,
						'status' => $request->status,
						'tran_date' => $request->tran_date,
						'error' => $request->error,
						'currency' => $request->currency,
						'card_issuer' => $request->card_issuer,
						'card_brand' => $request->card_brand,
						'card_sub_brand' => $request->card_sub_brand,
						'card_issuer_country' => $request->card_issuer_country,
						'card_issuer_country_code' => $request->card_issuer_country_code,
						'store_id' => $request->store_id,
						'verify_sign' => $request->verify_sign,
						'verify_key' => $request->verify_key,
						'verify_sign_sha2' => $request->verify_sign_sha2,
						'currency_type' => $request->currency_type,
						'currency_amount' => $request->currency_amount,
						'currency_rate' => $request->currency_rate,
						'base_fair' => $request->base_fair,
						'value_a' => $request->value_a,
						'value_b' => $request->value_b,
						'value_c' => $request->value_c,
						'value_d' => $request->value_d,
						'subscription_id' => $request->subscription_id,
						'risk_level' => $request->risk_level,
						'risk_title' => $request->risk_title,
					];
	
					if ($existingTransaction) {
						// Update existing transaction
						$existingTransaction->update($transaction_data);
						$message = 'Transaction is successfully updated.';
					} else {
						// Create a new transaction
						$order_details->transactions()->create($transaction_data);
						$message = 'Transaction is successfully completed.';
					}
	
					// Update order status to 'Processing' if it was pending
					if ($order_details->status == 0) {
						$order_details->update(['status' => 2]); // 2 means 'Processing'
					}
				}
			} elseif ($order_details->status == 2 || $order_details->status == 1) { // 2 = 'Processing', 1 = 'Completed'
				// The order status was already updated
				$message = 'Transaction is successfully completed.';
			} else {
				// If something went wrong, show an invalid transaction message
				$message = 'Invalid transaction.';
			}
		} else {
			// If order doesn't exist
			$message = 'Order not found.';
		}

		// Clear the cart session
		session()->forget('cart'); // Replace 'cart' with the actual name of your cart session if it's different
		session()->forget(['voucher_success', 'applied_voucher', 'voucher']);

		session(['order_ref' => $order_details->ref]);

		return redirect()->route('order.placed', ['order' => $order_details->ref])->with('message', $message);
	}
	
	public function paymentFail(Request $request)
	{
		// Retrieve the transaction ID from the request
		$tran_id = $request->input('tran_id');
	
		// Retrieve the order details with related transactions
		$order_details = Order::with('transactions', 'products')
			->where('ref', $tran_id)
			->first();
	
		// Initialize a message variable
		$message = 'Invalid Transaction';
	
		// Check if the order exists
		if ($order_details) {
			// Check if the order status is 'Pending' (0)
			if ($order_details->status == 0) {
				// Check for existing transaction
				$existingTransaction = $order_details->transactions()
					->where('ref', $tran_id)
					->whereNull('status') // Check if the status is NULL
					->first();
	
				// Prepare transaction data based on the failed request response
				$transaction_data = [
					'ref' => $tran_id,
					'order_id' => $order_details->id,
					'val_id' => $request->val_id,
					'amount' => $request->amount,
					'card_type' => $request->card_type,
					'store_amount' => $request->store_amount,
					'card_no' => $request->card_no,
					'bank_tran_id' => $request->bank_tran_id,
					'status' => $request->status,
					'tran_date' => $request->tran_date,
					'error' => $request->error,
					'currency' => $request->currency,
					'card_issuer' => $request->card_issuer,
					'card_brand' => $request->card_brand,
					'card_sub_brand' => $request->card_sub_brand,
					'card_issuer_country' => $request->card_issuer_country,
					'card_issuer_country_code' => $request->card_issuer_country_code,
					'store_id' => $request->store_id,
					'verify_sign' => $request->verify_sign,
					'verify_key' => $request->verify_key,
					'verify_sign_sha2' => $request->verify_sign_sha2,
					'currency_type' => $request->currency_type,
					'currency_amount' => $request->currency_amount,
					'currency_rate' => $request->currency_rate,
					'base_fair' => $request->base_fair,
					'value_a' => $request->value_a,
					'value_b' => $request->value_b,
					'value_c' => $request->value_c,
					'value_d' => $request->value_d,
					'subscription_id' => $request->subscription_id,
					'risk_level' => $request->risk_level,
					'risk_title' => $request->risk_title,
				];
	
				if ($existingTransaction) {
					// Update existing transaction with the failed data
					$existingTransaction->update($transaction_data);
					$message = 'Transaction failed, please try again!';
				} else {
					// Create a new failed transaction record
					$order_details->transactions()->create($transaction_data);
					$message = 'Transaction failed, please try again!';
				}
	
				// Update the order status to 'Failed' (6)
				$order_details->update(['status' => 6]);
	
				// Restore product quantities
				foreach ($order_details->products as $product) {
					Quantity::where('product_id', $product->id)
						->where('size_id', $product->pivot->size_id)
						->increment('quantity', $product->pivot->quantity);
				}
			} else {
				// If the order is already completed or processing
				$message = 'Transaction is already completed or in processing.';
			}
		} else {
			// If order does not exist
			$message = 'Order not found.';
		}
	
		// Redirect back to processCheckout
		return redirect()->route('checkout.process')->with('message', $message);
	}
	
	


    public function paymentCancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        // Retrieve the order details with related transactions
		$order_details = Order::with('transactions')
			->where('ref', $tran_id)
			->first();

        // Initialize a message variable
		$message = 'Invalid Transaction';
	
		// Check if the order exists
		if ($order_details) {
			// Check if the order status is 'Pending' (0)
			if ($order_details->status == 0) {
				// Check for existing transaction
				$existingTransaction = $order_details->transactions()
				->where('ref', $tran_id)
				->whereNull('status') // Check if the status is NULL
				->first();
			

				// Prepare transaction data based on the failed request response
				$transaction_data = [
					'ref' => $tran_id,
					'order_id' => $order_details->id,
					'val_id' => $request->val_id,
					'amount' => $request->amount,
					'card_type' => $request->card_type,
					'store_amount' => $request->store_amount,
					'card_no' => $request->card_no,
					'bank_tran_id' => $request->bank_tran_id,
					'status' => $request->status,
					'tran_date' => $request->tran_date,
					'error' => $request->error,
					'currency' => $request->currency,
					'card_issuer' => $request->card_issuer,
					'card_brand' => $request->card_brand,
					'card_sub_brand' => $request->card_sub_brand,
					'card_issuer_country' => $request->card_issuer_country,
					'card_issuer_country_code' => $request->card_issuer_country_code,
					'store_id' => $request->store_id,
					'verify_sign' => $request->verify_sign,
					'verify_key' => $request->verify_key,
					'verify_sign_sha2' => $request->verify_sign_sha2,
					'currency_type' => $request->currency_type,
					'currency_amount' => $request->currency_amount,
					'currency_rate' => $request->currency_rate,
					'base_fair' => $request->base_fair,
					'value_a' => $request->value_a,
					'value_b' => $request->value_b,
					'value_c' => $request->value_c,
					'value_d' => $request->value_d,
					'subscription_id' => $request->subscription_id,
					'risk_level' => $request->risk_level,
					'risk_title' => $request->risk_title,
				];
	
				if ($existingTransaction) {
					// Update existing transaction with the failed data
					$existingTransaction->update($transaction_data);
					$message = 'Transaction cancelled, Please try again!';
				} else {
					// Create a new failed transaction record
					$order_details->transactions()->create($transaction_data);
					$message = 'Transaction cancelled, Please try again!';
				}
	
				// Update the order status to 'Cancelled' (5)
				$order_details->update(['status' => 5]);

				// Restore product quantities
				foreach ($order_details->products as $product) {
					Quantity::where('product_id', $product->id)
						->where('size_id', $product->pivot->size_id)
						->increment('quantity', $product->pivot->quantity);
				}
			} else {
				// If the order is already completed or processing
				$message = 'Transaction is already completed or in processing.';
			}
		} else {
			// If order does not exist
			$message = 'Order not found.';
		}
	
		// Store the order reference in the session for redirection
		session(['order_ref' => $order_details->ref ?? null]);
	
		// Redirect back to processCheckout
		return redirect()->route('checkout.process')->with('message', $message);
	}

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

	
}

