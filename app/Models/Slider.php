<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        // Construct the public URL to the file (assuming files are stored in the 'public' disk)
        if ($this->image) {
            return Storage::disk('public')->url("sliders/{$this->image}");
        }

        return null; // Return null if there's no file
    }
}
