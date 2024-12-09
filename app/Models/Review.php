<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

	protected $fillable = ['user_id', 'username', 'content', 'status', 'rating'];

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

	public function getRatingStarsAttribute()
	{
		// If rating is a decimal, it should still calculate correctly.
		$fullStars = floor($this->rating); // Full stars
		$emptyStars = 5 - $fullStars; // Remaining empty stars
	
		return [
			'filled' => $fullStars,  // Number of filled stars
			'empty' => $emptyStars,  // Number of empty stars
		];
	}
	

}
