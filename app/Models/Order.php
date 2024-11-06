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

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}

	// In your Order model
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
					'imagePath' => $product->imagePaths[0] ?? url('/images/products/default.jpg'), // Get the first image path
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
		$this->discount = $validTransaction->order_discount ?? 0;
		$this->shipping_charge = $validTransaction->shipping_charge ?? 0;
		$this->order_total = $this->subtotal - $this->discount + $this->shipping_charge;
		$this->paid = $validTransaction->amount ?? 0;
		$this->unpaid_amount = $this->order_total - $this->paid;

		return $this;
	}

	public function getOrderItems()
	{
		return $this->products->unique('id')->map(function ($product) {
			$imagePath = $product->image_paths[0] ?? 'images/products/default.jpg'; 
			$sizeName = $product->sizes->firstWhere('id', $product->pivot->size_id)->name ?? 'N/A';

			return [
				'id' => $product->id,
				'title' => $product->title,
				'price' => $product->price,
				'sale' => $product->sale ? $product->price * (1 - $product->sale / 100) : $product->price,
				'categories' => $product->categories->pluck('title')->unique()->implode(', '),
				'size' => $sizeName,
				'quantity' => $product->pivot->quantity,
				'imagePath' => $imagePath,
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
}
