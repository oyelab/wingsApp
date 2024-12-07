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
		'slug',
		'description',
		'image',
		'status',
	];

	public function getImagePathAttribute()
    {
        if ($this->image) {
			// Get the absolute path of the image
			$imagePath = Storage::disk('public')->path("sections/{$this->image}");
	
			// Check if the image file exists
			if (file_exists($imagePath)) {
				// Process the image (compress on the fly)
				$image = Image::make($imagePath)
					->resize(1500, null, function ($constraint) {
						$constraint->aspectRatio(); // Maintain aspect ratio
						$constraint->upsize(); // Prevent upsizing
					})
					->encode('webp', 80); // Compress to JPEG with 80% quality
	
				// Return the base64-encoded inline image
				return 'data:image/webp;base64,' . base64_encode($image);
			}
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
