<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    use HasFactory;

	protected $fillable = [
        'product_id', // Add this line
        'size_id',
		'quantity',
    ];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
