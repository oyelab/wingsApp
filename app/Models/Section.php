<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Storage;

class Section extends Model
{
    use HasFactory;

	protected $fillable = [
		'title',
		'description',
		'image',
		'status',
	];

	public function getImagePathAttribute()
    {
        if ($this->image) {
			// Get the absolute path of the image
			return Storage::disk('public')->url("sections/{$this->image}");
		}

		return null;
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
