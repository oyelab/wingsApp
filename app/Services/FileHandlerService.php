<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class FileHandlerService
{
    /**
     * Store the uploaded file with a unique name and return only the filename.
     */
    public function storeFile(UploadedFile $file, string $tableName): string
    {
        // Generate a unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Store the file in the model's directory
        $file->storeAs("{$tableName}/", $filename, 'public');
        
        // Return only the filename (no path)
        return $filename;
    }

    /**
     * Update and replace the old file.
     */
    public function updateFile(UploadedFile $file, string $oldFilename, string $tableName): string
    {
        // Delete the old file first
        $this->deleteFile("{$tableName}/{$oldFilename}");

        // Store the new file and return only the new filename
        return $this->storeFile($file, $tableName);
    }

    /**
     * Delete a single file.
     */
    public function deleteFile(string $path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Delete all files in a directory.
     */
    public function deleteAllFilesInModelDirectory(string $tableName)
    {
        $files = Storage::disk('public')->files($tableName);

        foreach ($files as $file) {
            $this->deleteFile($file);
        }
    }
}
