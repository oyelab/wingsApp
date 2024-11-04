<?php

namespace App\Models;
use App\Models\Category;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

	// Fillable attributes for mass assignment
    protected $fillable = [
        'title',
        'slug',
        'price',
        'sale',
        'description',
		'specifications',
		'categories',
        'images', // Assuming this will store JSON data for images
        'meta_title',
        'keywords',
		'meta_desc',
		'og_image',
    ];


	public function sizes()
	{
		return $this->belongsToMany(Size::class, 'quantities')->withPivot('quantity');
	}

	public function availableSizes()
	{
		return $this->sizes()->wherePivot('quantity', '>', 0);
	}

	public function quantities()
	{
		return $this->hasMany(Quantity::class);
	}

	public function categories()
	{
		    return $this->belongsToMany(Category::class, 'category_product');

		// Assuming 'categories' field contains JSON encoded category IDs
		// return Category::whereIn('id', json_decode($this->categories))->get();
	}

	public function specifications()
	{
		// Decode specifications and ensure it's an array or return an empty array if null
		$specIds = json_decode($this->specifications, true); // true to decode as array

		// Check if it's a valid array
		if (is_array($specIds) && count($specIds) > 0) {
			return Specification::whereIn('id', $specIds)->get();
		}

		// Return an empty collection if no valid specifications are found
		return collect();
	}

	public function orders()
	{
		return $this->belongsToMany(Order::class)
					->withPivot('size_id', 'quantity')
					->withTimestamps();
	}

	public function getOfferPriceAttribute()
	{
		return number_format(floor($this->price - ($this->price * $this->sale / 100)), 2, '.', '');
	}

	// Calculate discount for a given quantity
    public function calculateDiscount($quantity)
    {
        // Calculate the discount amount based on the offer price
        $offerPrice = $this->getOfferPriceAttribute();
        return ($this->price * $quantity) - ($offerPrice * $quantity);
    }

	// Product model
	public function getImagePathsAttribute(): array
	{
		$images = json_decode($this->images) ?? [];
		$baseURL = url('/'); // Get the base URL of the application
	
		return array_map(fn($image) => $baseURL . '/images/products/' . $image, $images) ?: [$baseURL . '/images/products/default.jpg'];
	}
	
	// Latest Products (e.g., created within the last 30 days, ordered by creation date)
	public function scopeLatestProducts($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->where('created_at', '>=', now()->subDays(30))
					->orderBy('created_at', 'desc');
	}

	// Top Ordered Products
	public function scopeTopOrders($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->withCount('orders')
					->orderBy('orders_count', 'desc');
	}

	// Most Viewed Products
	public function scopeMostViewed($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->orderBy('views', 'desc');
	}

	// Offer Products: Products that are active and have a non-null sale field
	public function scopeOfferProducts($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->whereNotNull('sale') // Ensure the sale field is not null
					->orderBy('views', 'desc'); // Order by views in descending order
	}


	// Trending Products (based on custom trend score)
	public function scopeTrending($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->withCount('orders')
					->orderByRaw('(views * 0.6) + (orders_count * 1.5) DESC');
	}

}
