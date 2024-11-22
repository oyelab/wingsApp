<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{

    use HasFactory;

	protected $fillable = ['title', 'slug', 'banner', 'thumbnail', 'short_description', 'status', 'order'];

    public function details()
    {
        return $this->hasMany(ShowcaseDetail::class);
    }

	// Showcase Model (Showcase.php)

	public function getBannerImagePathAttribute()
	{
		return asset("storage/showcases/{$this->id}/banner/{$this->banner}");
	}
	
	public function getThumbnailImagePathAttribute()
	{
		return asset("storage/showcases/{$this->id}/thumbnail/{$this->thumbnail}");
	}
	
}
