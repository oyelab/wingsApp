<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quantity;
use App\Models\Transaction;
use App\Models\Category;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Str;



class PaymentController extends Controller
{
	private $products;

    public function __construct()
    {
        // Initialize the products array
        $this->products = [
            ['id' => 68, 'size_id' => 1, 'quantity' => 5],
            ['id' => 68, 'size_id' => 1, 'quantity' => 5],
            ['id' => 69, 'size_id' => 4, 'quantity' => 5],
            ['id' => 69, 'size_id' => 5, 'quantity' => 10],
            // Add more products as needed
        ];
    }
	
	public function checkout()
	{

		return view('test.checkout', [
		]);
	}

	public function processCheckout(Request $request)
    {
		$tran_id = 'ws' . substr(Str::uuid()->toString(), 0, 8);

		// Get the selected location value
		$location = $request->input('location');

        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:COD,Full Payment', // Ensure it matches your form values
        ]);

		// Directly define the products array with sizes and quantities
		$products = [
			['id' => 68, 'size_id' => 1, 'quantity' => 5], // Product ID 1, Size ID 2, Quantity 3
			['id' => 68, 'size_id' => 1, 'quantity' => 5], // Product ID 2, Size ID 1, Quantity 1
			['id' => 69, 'size_id' => 4, 'quantity' => 5], // Product ID 1, Size ID 2, Quantity 3
			['id' => 69, 'size_id' => 5, 'quantity' => 10], // Product ID 2, Size ID 1, Quantity 1
			// Add more products as needed
		];



		// Calculate delivery charge based on location
    	$shipping_charge = ($location === 'inside') ? 60 : 120;
	
		// Calculate the base fair (total amount before discount)
		$base_fair = collect($products)->sum(function ($product) {
			$productDetails = Product::find($product['id']);
			return $productDetails->price * $product['quantity'];
		});

		// Calculate total discount based on the `sale` field in the products table
		$discount_amount = collect($products)->sum(function ($product) {
			$productDetails = Product::find($product['id']);
			return ($productDetails->price * $product['quantity']) * ($productDetails->sale / 100);
		});

		// Calculate the subtotal after discount
		$order_total = $base_fair - $discount_amount; // Calculate subtotal

		// dd($shipping_charge);

		// Define the payment method (you will set this based on customer selection)
		$payment_method = $validated['payment_method']; // 'COD' or 'Full Payment'

		// Set total based on the payment method
		$total = ($payment_method === 'COD') ? $shipping_charge : ($order_total + $shipping_charge);

		// return $products;

		$userId = auth()->check() ? auth()->user()->id : null;



		// Create the order
		$order = Order::create([
			'ref' => $tran_id,
			'user_id' => $userId, // Set customer_id or keep it null
			'name' => $validated['name'],
			'email' => $validated['email'],
			'phone' => $validated['phone'],
			'address' => $validated['address'],
			'status' => 0, // Set order status as Pending initially
		]);


		// Create the transaction data
		$transaction_data = [
			'ref' => $tran_id,
			'order_id' => $order->id,
			'shipping_charge' => $shipping_charge, // Always store shipping charge
			'order_total' => $order_total,
			'payment_status' => $payment_method === 'Full Payment', // true if Full Payment, false if COD
		];

		// return $transaction_data;

		// Store the transaction data
		$order->transactions()->create($transaction_data);

	
		foreach ($products as $product) {
			$productId = $product['id'];
			$sizeId = $product['size_id'];
			$quantityToOrder = $product['quantity'];
		
			// Attach product to order
			$order->products()->attach($productId, [
				'size_id' => $sizeId,
				'quantity' => $quantityToOrder,
			]);
		
			// Decrement quantity in the quantities table
			Quantity::where('product_id', $productId)
				->where('size_id', $sizeId)
				->decrement('quantity', $quantityToOrder);
		}

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
            'base_fair' => $base_fair,
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
		// return $message;
		// return $order_details;

		session(['order_ref' => $order_details->ref]);

		return redirect()->route('order.placed', ['order' => $order_details->ref])->with('message', $message);
	}

	public function xpaymentSuccess()
	{
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

		// return $order_details;

		$order_details->tran_date = $request->tran_date;

		// $orderId = $order_details->id;
		// $order_details = Order::with('transactions')->findOrFail($orderId);
		
		

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

		// Now $total_discount contains the overall discount for the order
		// $product_total contains the total amount for all products without discounts


		// return $total_discount;
		$order_details->subtotal = $product_total;
		$order_details->discount = $total_discount;
		$order_details->shipping_charge = $order_details->transactions->first()->shipping_charge;

		$order_details->order_total = $product_total - $total_discount + $order_details->shipping_charge;
		$order_details->paid = $request->amount;
		$order_details->unpaid_amount = $order_details->order_total - $order_details->paid;

		// return $order_details->shipping_charge;
		
		// Check if the user is signed up
		$userSignedUp = auth()->check(); // Check if the user is logged in
	
		// Pass order details and products to the view
		return view('test.success', [
			'order_details' => $order_details,
			'order_items' => $order_items,
			'message' => $message, // Pass the message to the view
			'userSignedUp' => $userSignedUp,
		]);
	}
	
	


    public function paymentFail(Request $request)
	{
		$tran_id = $request->input('tran_id');

		// Retrieve order details
		$order_details = Order::with('transactions')
			->where('ref', $tran_id)
			->first();

		// Initialize a default message for clarity
		$message = 'Invalid Transaction';

		// Check if the order exists
		if ($order_details) {
			if ($order_details->status == 0) {
				// Update status to 'Cancelled' (3)
				$order_details->update(['status' => 3]);
				$message = 'Transaction was cancelled.';
			} else if (in_array($order_details->status, [1, 2])) {
				// Status is already completed or processing
				$message = 'Transaction is successfully completed.';
			}
		}

		return $message;
	}


    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


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

