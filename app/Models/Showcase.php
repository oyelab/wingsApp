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
		return asset("storage/showcases/{$this->slug}/{$this->banners}");
	}
	
	public function getThumbnailImagePathAttribute()
	{
		return asset("storage/showcases/{$this->slug}/{$this->thumbnail}");
	}
	
}
