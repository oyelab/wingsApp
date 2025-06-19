<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Asset extends Model
{
    use HasFactory;

	protected $fillable = ['type', 'title', 'file', 'description', 'url'];


	public function getFilePathAttribute()
    {
        // Construct the public URL to the file (assuming files are stored in the 'public' disk)
        if ($this->file) {
            return Storage::disk('public')->url("assets/{$this->file}");
        }
        return null; // Return null if there's no file
    }
}
