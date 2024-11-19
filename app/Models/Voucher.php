<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

	protected $fillable = ['code', 'discount', 'status', 'criteria']; // Include criteria

    protected $casts = [
        'criteria' => 'array', // Cast criteria to an array
    ];

	// public function calculateVoucherDiscount($totalAmount)
	// {
	// 	if ($this->discount && $totalAmount > 0) {
	// 		return ($totalAmount * $this->discount) / 100;
	// 	}
	// }
}
