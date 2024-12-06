<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Page extends Model
{
    use HasFactory;

	protected $fillable = ['title', 'content', 'image', 'slug', 'type', 'order'];


	public function getImagePathAttribute()
    {
        // Construct the public URL to the file (assuming files are stored in the 'public' disk)
        if ($this->image) {
            return Storage::disk('public')->url("pages/{$this->image}");
        }

        return null; // Return null if there's no file
    }
	

}
