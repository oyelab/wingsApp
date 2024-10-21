<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_size')->withPivot('quantity');
	}

	public function quantities()
	{
		return $this->hasMany(Quantity::class, 'size_id');
	}

}
