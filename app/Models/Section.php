<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

	protected $fillable = [
		'title',
		'slug',
		'description',
		'image',
		'status',
	];

	public function getImagePathAttribute()
	{
		// Check if the image path exists and if the file is in storage
		if ($this->attributes['image']) {
			// Return the full URL to the image in storage
			return asset('storage/sections/' . $this->attributes['image']);
		}
		
	}
	// public function loadProducts()
    // {
    //     // Get the scope method name from the section model
    //     $scopeMethod = 'scope' . ucfirst($this->scopeMethod); // Converts 'latest' to 'scopeLatest'

	// 	// return $scopeMethod;
    //     // Check if the scope method exists on the Product model
    //     if (method_exists(Product::class, $scopeMethod)) {
    //         // Call the scope method on the Product model and return the results
    //         return Product::$scopeMethod(); // Call the scope statically
    //     }

    //     return collect(); // Return an empty collection if the scope method doesn't exist
    // }
}
