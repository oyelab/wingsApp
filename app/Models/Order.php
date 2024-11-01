<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

	protected $fillable = [
		'ref',
		'user_id',
        'name',
        'email',
        'phone',
        'address',
		'amount',
		'status',
		'terms',
    ];

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}

	// In your Order model
	public function products()
	{
		return $this->belongsToMany(Product::class)
					->withPivot('size_id', 'quantity'); // Ensure pivot fields are included
	}
	public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

}
