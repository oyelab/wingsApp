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

	protected $fillable = ['type', 'title', 'file', 'description'];

    // Store file upload functionality
    public static function uploadFile($file)
    {
        // Store the file and return its path
        return $file->store('assets', 'public');
    }

	public static function handleFileUpload($file, $title)
    {
        $titleSlug = Str::slug($title);
        $extension = $file->getClientOriginalExtension();
        $baseFilename = $titleSlug;

        // Generate a unique filename
        $counter = 0;
        do {
            $filename = $counter > 0
                ? "{$baseFilename}-{$counter}.{$extension}"
                : "{$baseFilename}.{$extension}";
            $exists = Storage::disk('public')->exists("assets/{$filename}");
            $counter++;
        } while ($exists);

        // Store the file and return the filename
        $file->storeAs('assets', $filename, 'public');
        return $filename;
    }

	public function setFileAttribute($file)
    {
        if ($file) {
            $this->attributes['file'] = $this->processImage($file, $this->title);
        }
    }

	public function getFilePathAttribute()
    {
        return url('uploads/assets/' . $this->file);
    }

	protected function processImage($file, $title)
    {
        $path = public_path('uploads/assets');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $slug = Str::slug($title);
        $extension = 'webp'; // Save all images in WebP format
        $filename = "{$slug}.{$extension}";
        $counter = 1;

        // Check for existing files and increment the counter for unique filenames
        while (file_exists($path . '/' . $filename)) {
            $filename = "{$slug}-{$counter}.{$extension}";
            $counter++;
        }

        // Process the image
        $image = Image::make($file)
            ->encode($extension, 85); // Reduce quality to 85%
        $image->save($path . '/' . $filename);

        return $filename;
    }

}
