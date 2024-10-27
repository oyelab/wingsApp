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
    ];

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}

	public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('size_id', 'quantity')
                    ->withTimestamps();
    }

}
