<?php

namespace App\Models;
use App\Models\Category;


use App\Models\Scopes\SortProducts;
use App\Models\Scopes\SearchProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected static function booted()
    {
        // Add SortProducts global scope
        static::addGlobalScope(new SortProducts);

        // Add SearchProducts global scope
        static::addGlobalScope(new SearchProducts);
    }

	

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
		return $this->belongsToMany(Category::class, 'category_product')
			->withPivot('category_id', 'subcategory_id'); // Make sure we load the pivot data
	}

	// Define the relationship with the Review model
    public function reviews()
    {
        return $this->belongsToMany(Review::class, 'product_review', 'product_id', 'review_id');
    }

	// Add this accessor for the review count
	public function getReviewsCountAttribute()
	{
		return $this->reviews()->count();
	}

	// Method to calculate average rating
	public function getAverageRatingAttribute()
	{
		return $this->reviews()->avg('rating');  // Average of the 'rating' column in the 'reviews' table
	}

	public function getSubcategoryAttribute()
	{
		// Get the first category related to the product
		$category = $this->categories->first(); 

		// Check if the category has a subcategory and get the subcategory
		if ($category && $category->pivot) {
			$subcategoryId = $category->pivot->subcategory_id;
			
			// Retrieve the subcategory using the subcategory_id
			$subcategory = Category::find($subcategoryId);

			// Return the subcategory instance if it exists, or null if not
			return $subcategory ? $subcategory : null;
		}

		return null; // Return null if no subcategory found
	}

	public function getCategoryDisplayAttribute()
	{
		// Get the first category (main category)
		$mainCategory = $this->categories->first();

		// Check if a main category exists
		if ($mainCategory) {
			// Get the subcategory using the pivot relation (this should be loaded)
			$subcategoryId = $this->categories->first()->pivot->subcategory_id;
			$subcategory = Category::find($subcategoryId);

			// Return both main category title and subcategory title if subcategory exists
			if ($subcategory) {
				return $mainCategory->title . ' - ' . $subcategory->title;
			}

			// If no subcategory, return only the main category title
			return $mainCategory->title;
		}

		// If no categories, return "Category not found"
		return 'Category not found';
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
	
	public function scopePrice($query, $direction = 'asc')
	{
		return $query->where('status', 1)
		->orderBy('price', $direction);
	}

	// Latest Products (e.g., created within the last 30 days, ordered by creation date)
	public function scopeLatestProducts($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->orderBy('created_at', 'desc');
	}

	public function scopeOldestProducts($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->orderBy('created_at', 'asc');
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
					->orderBy('sale', 'desc'); // Order by views in descending order
	}


	// Trending Products (based on custom trend score)
	public function scopeTrending($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->withCount('orders')
					->orderByRaw('(views * 0.6) + (orders_count * 1.5) DESC');
	}

	public function scopeBulks($query)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					 ->withCount('orders') // Count related orders if needed
					 ->orderBy('id', 'DESC'); // Order by 'id' in descending order
	}

	// Related Products: Products in the same category or similar attributes
	public function scopeRelatedProducts($query, $product)
	{
		return $query->where('status', 1) // Ensure status is true (active)
					->where('id', '!=', $product->id) // Exclude the current product
					->whereHas('categories', function ($q) use ($product) {
						$q->whereIn('categories.id', $product->categories->pluck('id'));
					})
					->orderBy('created_at', 'desc'); // Order by creation date
	}

	// In your Product model (Product.php)
	// public function scopeSearchProducts($query, $searchTerm)
	// {
	// 	if (!empty($searchTerm)) {
	// 		return $query->where('title', 'like', '%' . $searchTerm . '%')
	// 					->orWhere('description', 'like', '%' . $searchTerm . '%')
	// 					->orWhere('meta_desc', 'like', '%' . $searchTerm . '%')
	// 					->orWhere('meta_title', 'like', '%' . $searchTerm . '%')
	// 					->orWhere('keywords', 'like', '%' . $searchTerm . '%')
	// 					->orWhereRaw("title SOUNDS LIKE ?", [$searchTerm]) // Fuzzy match on 'title'
	// 					->orWhereRaw("description SOUNDS LIKE ?", [$searchTerm]) // Fuzzy match on 'description'
	// 					->orWhereRaw("keywords SOUNDS LIKE ?", [$searchTerm]); // Fuzzy match on 'keywords'
	// 	}

	// 	return $query;
	// }

}
