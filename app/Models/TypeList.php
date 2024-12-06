<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeList extends Model
{
    use HasFactory;

	protected $table = 'type_lists';

	// Cast the 'items' column to an array
	protected $casts = [
		'items' => 'array',  // Automatically casts JSON column to array
	];
}
