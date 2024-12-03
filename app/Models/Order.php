<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Order extends Model
{
    use HasFactory;

	protected $fillable = [
		'ref',
		'user_id',
        'name',
        'email',
        'phone',
        'address',
		'amount',
		'status',
		'terms',
    ];

	public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}


	public function products()
	{
		return $this->belongsToMany(Product::class)
					->withPivot('size_id', 'quantity'); // Ensure pivot fields are included
	}
	
	public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

	public function getTopPicks()
	{
		return self::with('products')
			->whereIn('status', [1, 2, 3])
			->get()
			->pluck('products')
			->flatten()
			->groupBy('id')
			->map(function ($products) {
				$product = $products->first();
				return [
					'product' => $product,
					'total_quantity' => $products->sum(fn($product) => $product->pivot->quantity),
					'imagePath' => $product->thumbnail ?? url('/images/products/default.jpg'), // Get the first image path
					'offerPrice' => $product->offerPrice, // Access offer price here
				];
			})
			->sortByDesc('total_quantity')
			->values();
	}

	

	// Order.php (Model)

	public function getOrderDetails()
	{
		return $this->load('transactions', 'products.categories', 'products.sizes');
	}

	public function calculateTotals()
	{

		$validTransaction = $this->transactions->firstWhere('status', 'VALID');

		$this->subtotal = $validTransaction->subtotal ?? 0;
		$this->shipping_charge = $validTransaction->shipping_charge ?? 0;
		$this->discount = $validTransaction->order_discount ?? 0;
		$this->voucher = $validTransaction->voucher ?? 0;
		$this->order_total = number_format($this->subtotal - $this->discount - $this->voucher + $this->shipping_charge, 2, '.', '');
		$this->paid = $validTransaction->amount ?? 0;
		$this->unpaid_amount = number_format($this->order_total - $this->paid, 2, '.', '');

		return $this;
	}

	

	public function getOrderItems()
	{
		return $this->products->map(function ($product) {
			$imagePath = $product->image_paths[0];
			$sizeName = $product->sizes->firstWhere('id', $product->pivot->size_id)->name ?? 'N/A';

			// Calculate sale price (if applicable)
			$salePrice = $product->sale 
			? $product->price * (1 - $product->sale / 100) 
			: $product->price;
		
			// Calculate full price (price x quantity)
			$fullPrice = $product->price * $product->pivot->quantity;
			
			return [
				'id' => $product->id,
				'title' => $product->title,
				'price' => $product->price,
				'sale' => $salePrice,
				'categories' => $product->categories->pluck('title')->unique()->implode(', '),
				'size' => $sizeName,
				'quantity' => $product->pivot->quantity,
				'imagePath' => $imagePath,
				'fullPrice' => number_format($fullPrice, 2, '.', ''), // Format for readability
			];
		});
	}


	public function getTranDateAttribute()
	{
		// Filter transactions to find the first one where status is "VALID"
		$validTransaction = $this->transactions->firstWhere('status', 'VALID');
		
		// Format the date if a valid transaction is found
		return $validTransaction
        ? Carbon::parse($validTransaction->tran_date)->format('F j, Y, g:i A')
        : null;
	}

	public static function totalSalesVolume($year = null)
    {
        // Default to the current year if no year is passed
        $year = $year ?? now()->year;

        // Fetch completed orders and sum their related transaction amounts
        return self::where('status', 3) // Filter by completed orders (status = 3)
                    ->whereYear('created_at', $year) // Filter by the provided year
                    ->get() // Fetch all completed orders for the year
                    ->sum(function ($order) {
                        // Sum the 'amount' field from related transactions for each order
                        return $order->transactions->sum('order_total');
                    });
    }

	public static function getMonthlySales($year = null)
    {
        // Default to the current year if no year is passed
        $year = $year ?? now()->year;

        // Fetch orders with completed status
        $orders = self::where('status', 3) // Filter by completed orders (status = 3)
                    ->whereYear('created_at', $year) // Filter by the provided year
                    ->get();

        // Map the sales data by month
        $monthlySales = collect(range(1, 12))->map(function ($month) use ($orders) {
            // Filter transactions for each order and sum their order_total for each month
            $salesForMonth = $orders->filter(function ($order) use ($month) {
                // Only consider transactions from the current month
                return $order->created_at->month == $month;
            })->sum(function ($order) {
                // Sum the order_total for each order, including its related transactions
                return $order->transactions->sum('order_total');
            });

            return $salesForMonth;
        });

        return $monthlySales;
    }

	public static function getMonthlyOrders($year = null)
    {
        // Default to the current year if no year is passed
		$year = $year ?? now()->year;

		// Fetch orders with completed status
		$orders = self::where('status', 3) // Filter by completed orders (status = 3)
					->whereYear('created_at', $year) // Filter by the provided year
					->get();

		// Map the counts by month
		$monthlyOrderCounts = collect(range(1, 12))->map(function ($month) use ($orders) {
			// Count the orders for each month
			$ordersForMonth = $orders->filter(function ($order) use ($month) {
				// Only consider orders from the current month
				return $order->created_at->month == $month;
			})->count();

			return $ordersForMonth;
		});

		// Calculate the total number of completed orders for the year
		$totalOrders = $orders->count();

		return [
			'monthly' => $monthlyOrderCounts,
			'total' => $totalOrders,
		];
    }
}
