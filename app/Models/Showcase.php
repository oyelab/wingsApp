<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Showcase extends Model
{

    use HasFactory;

	protected $fillable = ['title', 'slug', 'banners', 'thumbnail', 'og_image', 'short_description', 'status', 'order'];

	// Showcase Model (Showcase.php)

	public function getBannersImagePathAttribute()
	{
		// Decode the banners JSON field into an array
		$banners = json_decode($this->banners, true);
	
		if (!is_array($banners)) {
			$banners = [];
		}
	
		// Map each banner to its correct path and return as an array
		return collect($banners)->map(function ($banner) {
			return Storage::disk('public')->url("showcases/{$this->id}/{$banner}");
		})->all(); // Return as plain array
	}
	
	
	
	public function getThumbnailImagePathAttribute()
	{

		if ($this->thumbnail) {
			// Get the absolute path of the image
			return Storage::disk('public')->url("showcases/{$this->id}/{$this->thumbnail}");
		}

		return null;
	}

	public function getOgImagePathAttribute()
	{

		if ($this->og_image) {
			// Get the absolute path of the image
			return Storage::disk('public')->url("showcases/{$this->id}/{$this->og_image}");
		}

		return null;
	}

}
