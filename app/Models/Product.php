<?php

namespace App\Models;
use App\Models\Category;


use App\Models\Scopes\SortProducts;
use App\Models\Scopes\SearchProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Intervention\Image\Facades\Image; // Make sure Intervention is installed and configured


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
        'meta_title',
        'keywords',
		'meta_desc',
		'og_image',
		'images',
    ];

	protected $casts = [
		'images' => 'array',
	];


	public function sizes()
	{
		return $this->belongsToMany(Size::class, 'quantities')->withPivot('quantity');
	}

	public function availableSizes()
	{
		return $this->sizes()->withPivot('quantity'); // Include the quantity in the pivot table
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
		return $this->belongsToMany(Review::class, 'product_review', 'product_id', 'review_id')
					->where('status', true); // Filter reviews where status is true
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
	
		// Check if the category exists and has a pivot table
		if ($category && $category->pivot) {
			// Get subcategory_id from the pivot table
			$subcategoryId = $category->pivot->subcategory_id;
	
			// Retrieve the subcategory using the subcategory_id
			$subcategory = Category::find($subcategoryId);
	
			if ($subcategory) {
				// Attach the parent category to the subcategory dynamically
				$subcategory->setAttribute('category', $category);
			}
	
			// Return the subcategory instance (with category attached) or null
			return $subcategory;
		}
	
		return null; // Return null if no category or subcategory is found
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
		// Check if the sale percentage is greater than 0
		if ($this->sale && $this->sale > 0) {
			// Calculate the offer price based on the sale percentage
			return number_format(floor($this->price - ($this->price * $this->sale / 100)), 2, '.', '');
		}
	
		// If no sale, return null or the original price as offer price
		return null; // or you can return $this->price if you prefer
	}
	

	// Calculate discount for a given quantity
	public function calculateDiscount($quantity)
	{
		// Get the offer price using the getOfferPriceAttribute method
		$offerPrice = $this->getOfferPriceAttribute();
	
		// If there's no offer price, return null (no discount)
		if ($offerPrice === null) {
			return null;
		}
	
		// Calculate and return the discount amount directly
		return ($this->price * $quantity) - ($offerPrice * $quantity) === 0 ? null : ($this->price * $quantity) - ($offerPrice * $quantity);
	}
	




	public function getImagePathsAttribute()
	{
		$collectionId = $this->id; // Get the product ID
		$storagePath = "public/collections/{$collectionId}";
	
		// Filter out the OG image from the images
		$filteredImages = array_filter($this->images ?? [], function ($filename) use ($storagePath) {
			$fullPath = Storage::url("{$storagePath}/{$filename}");
			return $fullPath !== $this->ogImagePath; // Exclude the OG image
		});
	
		// Always return an array, even if empty
		return array_map(function ($filename) use ($storagePath) {
			return Storage::url("{$storagePath}/{$filename}");
		}, $filteredImages);
	}
	
	
	

	public function getAllImagePathsAttribute()
	{
		$collectionId = $this->id; // Get the product ID
		$storagePath = "collections/{$collectionId}"; // Path without 'public/'

		// Get all image filenames from the 'images' attribute
		$allImages = $this->images ?? [];

		// Map the image filenames to their full paths
		return array_map(function ($filename) use ($storagePath) {
			return Storage::url("{$storagePath}/{$filename}");
		}, $allImages);
	}


	public function getThumbnailAttribute()
	{
		// Get the array of image paths
		$imagePaths = $this->image_paths;
	
		// Return the first image path or null if the array is empty
		return $imagePaths[0] ?? null;
	}

	public function getOgImagePathAttribute()
	{
		$collectionId = $this->id; // Get the product ID
		$storagePath = "collections/{$collectionId}"; // Path without 'public/'
	
		$ogImage = $this->og_image; // Assuming the 'og_image' field contains the filename or path
	
		// Check if there is an og_image, return null if not
		if (empty($ogImage)) {
			return null;
		}
	
		// Generate a full URL for the image
		return url(Storage::url("{$storagePath}/{$ogImage}"));
	}
	
	
	

	// public function getOgImagePathAttribute()
	// {
	// 	$collectionId = $this->id; // Get the product ID
	// 	$storagePath = "public/collections/{$collectionId}";
		
	// 	// Target aspect ratio
	// 	$targetRatio = 1.91; 

	// 	foreach ($this->images ?? [] as $filename) {
	// 		$filePath = storage_path("app/{$storagePath}/{$filename}"); // Local file path
			
	// 		if (file_exists($filePath)) {
	// 			// Use Intervention Image to get the dimensions
	// 			$image = Image::make($filePath);
	// 			$width = $image->width();
	// 			$height = $image->height();
				
	// 			// Calculate the aspect ratio
	// 			$aspectRatio = $width / $height;

	// 			// Check if the aspect ratio is approximately 1.91:1
	// 			if (abs($aspectRatio - $targetRatio) < 0.01) { // Allow a small margin of error
	// 				return Storage::url("{$storagePath}/{$filename}"); // Return the full URL
	// 			}
	// 		}
	// 	}

	// 	return null; // Return null if no image matches the criteria
	// }



	// In Product model

	public function getKeywordsStringAttribute()
	{
		// Decode the JSON string and implode it into a comma-separated string
		$keywords = json_decode($this->keywords, true);

		// Return the keywords as a comma-separated string, or an empty string if no keywords
		return $keywords ? implode(', ', $keywords) : '';
	}


	
	public function scopePrice($query, $direction = 'asc')
	{
		return $query->where('status', 1) // Ensure the product is active
			->whereNotNull('price') // Only include products with a non-null price
			->orderBy('price', $direction); // Order by price
	}
	

	// Latest Products (e.g., created within the last 30 days, ordered by creation date)
	public function scopeLatestProducts($query)
	{
		return $query->orderBy('created_at', 'desc');
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
					 ->withCount(['orders' => function($query) {
						 $query->whereIn('status', [1, 2, 3]); // Only count orders with status 1, 2, or 3
					 }])
					 ->having('orders_count', '>=', 1) // Only include products with at least 1 matching order
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
		return $query->whereNotNull('sale') // Ensure the sale field is not null
					->orderBy('sale', 'desc'); // Order by views in descending order
	}


	// Trending Products (based on custom trend score)
	public function scopeTrending($query)
	{
		return $query->withCount('orders')
					->orderByRaw('(views * 0.6) + (orders_count * 1.5) DESC');
	}




	public function scopeBulks($query)
	{
		return $query->withCount('orders') // Count related orders if needed
					 ->whereDoesntHave('categories', function($q) {
						 $q->where('categories.id', 1); // Explicitly specify the table for id
					 })
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

	// Accessor for total sales
	public function getTotalSalesAttribute()
	{
		return $this->orders->sum('quantity'); // Assuming orders relation exists
	}

	// Accessor for total stock
	public function getTotalStockAttribute()
	{
		// Sum up the quantity for all size_id entries of the product
		return $this->quantities->sum('quantity');
	}

	public function isAvailable()
	{
		// Check if the total stock is greater than zero
		return $this->getTotalStockAttribute() > 0;
	}


	// Accessor for total clicks (e.g., from a Clicks table)
    public function getTotalClicksAttribute()
    {
        return $this->views->count(); // Assuming clicks relation exists
    }
}
