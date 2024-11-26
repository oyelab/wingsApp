<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

	protected $fillable = ['title', 'content', 'image', 'slug', 'type', 'order'];

	public function getImagePathAttribute()
	{
		// Check if the image path exists and if the file is in storage
		if ($this->attributes['image']) {
			// Return the full URL to the image in storage
			return asset('storage/pages/images/' . $this->attributes['image']);
		}
		
	}
	

}
