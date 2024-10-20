<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

	protected $fillable = [
        'title',
        'slug',
        'status',
        'order',
        'image', // Assuming this will store JSON data for images
        'parent_id',
        'description',
    ];

	public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}
