<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

	protected $guarded = []; // Disable mass assignment protection

	public function order()
	{
		return $this->belongsTo(Order::class);
	}


}
