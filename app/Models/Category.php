<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Category extends Model
{
	public function getRouteKeyName()
    {
        return 'slug'; // This tells Laravel to use 'slug' for model binding
    }

    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'order',
        'image', // Assuming this will store JSON data for images
        'parent_ids',
        'description',
    ];

	public function products()
	{
		return $this->belongsToMany(Product::class, 'category_product')
			->withPivot('category_id', 'subcategory_id'); // Ensure that we load pivot data
	}

	public function subcategories()
	{
		return $this->hasMany(Category::class, 'parent_category_id');
	}

    /**
     * Fetch categories for a specific product.
     *
     * @param  int|\App\Models\Product  $product
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCategoriesForProduct($product)
    {
        // Check if the product is an instance of Product or an ID
        if (is_numeric($product)) {
            return self::whereHas('products', function ($query) use ($product) {
                $query->where('id', $product);
            })->get();
        } elseif ($product instanceof Product) {
            return $product->categories; // Assuming a `categories` relationship in the Product model
        }

        return collect(); // Return an empty collection if the input is invalid
    }

	public function getImagePathAttribute()
    {
        return Storage::url('public/images/categories/' . $this->image);
    }

	// Get the child categories (categories that have this category as their parent)


	public function parents()
    {
        return $this->belongsToMany(Category::class, 'category_parent', 'child_id', 'category_id');
    }

    public function children()
    {
        return $this->belongsToMany(Category::class, 'category_parent', 'category_id', 'child_id');
    }
}

