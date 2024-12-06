<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

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
        // Construct the public URL to the file (assuming files are stored in the 'public' disk)
        if ($this->image) {
            return Storage::disk('public')->url("sections/{$this->image}");
        }

        return null; // Return null if there's no file
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
