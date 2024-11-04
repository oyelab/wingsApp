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
        return Storage::url('public/images/sliders/' . $this->image);
    }
}
