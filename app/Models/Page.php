<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Storage;

class Page extends Model
{
    use HasFactory;

	protected $fillable = ['title', 'second_title', 'content', 'image', 'slug', 'type', 'order'];


	public function getImagePathAttribute()
    {
        if ($this->image) {
			// Get the absolute path of the image
			return Storage::disk('public')->url("pages/{$this->image}");
		}

		return null;
    }

	// public function getImagePathAttribute()
    // {
    //     if ($this->image) {
	// 		// Get the absolute path of the image
	// 		$imagePath = Storage::disk('public')->path("pages/{$this->image}");
	
	// 		// Check if the image file exists
	// 		if (file_exists($imagePath)) {
	// 			// Process the image (compress on the fly)
	// 			$image = Image::make($imagePath)
	// 				->resize(1500, null, function ($constraint) {
	// 					$constraint->aspectRatio(); // Maintain aspect ratio
	// 					$constraint->upsize(); // Prevent upsizing
	// 				})
	// 				->encode('webp', 80); // Compress to JPEG with 80% quality
	
	// 			// Return the base64-encoded inline image
	// 			return 'data:image/webp;base64,' . base64_encode($image);
	// 		}
	// 	}
    // }
	

}
