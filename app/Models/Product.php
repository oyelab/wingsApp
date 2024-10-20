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
		return $this->belongsToMany(Size::class, 'product_size')->withPivot('quantity');
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
	
}
