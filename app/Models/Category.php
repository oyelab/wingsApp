<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'order',
        'image', // Assuming this will store JSON data for images
        'parent_id',
        'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
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
}

