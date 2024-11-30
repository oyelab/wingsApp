<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{

    use HasFactory;

	protected $fillable = ['title', 'slug', 'banners', 'thumbnail', 'short_description', 'status', 'order'];

	// protected $casts = [
	// 	'status' => 'boolean',  // Cast 'status' to a boolean value
	// ];
	
    public function details()
    {
        return $this->hasMany(ShowcaseDetail::class);
    }

	// Showcase Model (Showcase.php)

	public function getBannersImagePathAttribute()
	{
		// Decode the banners JSON field into an array
		$banners = json_decode($this->banners);
	
		// Map each banner to its correct path and return the array of paths
		return collect($banners)->map(function ($banner) {
			return asset("storage/showcases/{$this->id}/{$banner}");
		});
	}
	
	
	public function getThumbnailImagePathAttribute()
	{
		return asset("storage/showcases/{$this->id}/{$this->thumbnail}");
	}
	
}
