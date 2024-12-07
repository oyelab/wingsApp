<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Storage;

class Slider extends Model
{
    use HasFactory;


	protected $fillable = [
        'title', // Add this line
		'status',
		'order',
        'image',
    ];

	public function getSliderPathAttribute()
	{
		if ($this->image) {
			// Get the absolute path of the image
			return Storage::disk('public')->url("sliders/{$this->image}");
		}
		return null; // Return null if the image does not exist
	}
	
}
