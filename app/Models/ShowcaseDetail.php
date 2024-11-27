<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowcaseDetail extends Model
{


    use HasFactory;

	protected $fillable = ['showcase_id', 'heading', 'description', 'image'];

    public function showcase()
    {
        return $this->belongsTo(Showcase::class);
    }

	public function getImagePathsAttribute()
	{
		$images = json_decode($this->images, true) ?? [];
		return array_map(fn($image) => asset("storage/showcases/{$this->showcase_id}/details/{$image}"), $images);
	}

}
