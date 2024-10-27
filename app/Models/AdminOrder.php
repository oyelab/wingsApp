<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOrder extends Model
{
    use HasFactory;

	protected $fillable = [
        'name', 'address', 'email', 'phone', 'delivery_method', 
        'courier_charge', 'total_amount', 'payment_method',
    ];
}
