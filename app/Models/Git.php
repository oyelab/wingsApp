<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Git extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'email', 'subject', 'message', 'user_agent', 'ip_address'];
}
