<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

	protected $fillable = ['user_id', 'content', 'status', 'rating'];

	// Define the relationship with the Product model
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_review', 'review_id', 'product_id');
    }

	// Review.php
	public function user()
	{
		return $this->belongsTo(User::class);
	}

}
