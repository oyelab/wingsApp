<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function invoice()
	{
		return view('test.invoice');
	}

    public function create()
	{
		return view('test.new-file-upload');
	}

	public function store(Request $request)
	{
		// Get the original file size and compressed file size from the request
		$originalSize = $request->input('original_size'); // Size in bytes
		// return $originalSize;
		$compressedSize = $request->input('compressed_size'); // Size in bytes
		return $compressedSize;
	
		// Handle file upload (for example, storing the compressed image)
		if ($request->hasFile('file')) {
			$file = $request->file('file');
			
			// Store the file (example: saving to public storage)
			$path = $file->store('images', 'public');
	
			// You can save the file path, original size, and compressed size to the database if needed
			$image = new Test(); // Assuming you have an Image model
			$image->file_path = $path;
			$image->original_size = $originalSize;
			$image->compressed_size = $compressedSize;
			$image->save();
		}
	
		// Return both original and compressed sizes as a response
		return response()->json([
			'message' => 'File uploaded successfully',
			'original_size' => $originalSize, // Original file size
			'compressed_size' => $compressedSize, // Compressed file size
		]);
	}
}
