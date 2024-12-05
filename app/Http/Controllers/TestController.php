<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Order;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\View;





class TestController extends Controller
{
	public function generatePdf()
{
	    // Example data to pass to the template
		$order = Order::with('transactions')->findOrFail(132);
		$items = $order->getOrderDetails()->getOrderItems();
    	$html = view('test.pdf-template', compact('imagePath', 'order', 'items'))->render();

    $pdf = SnappyPdf::loadHTML($html)->setPaper('a4', 'portrait');

    return $pdf->download('document.pdf');
}
// 	public function generatePdf()
// {
// 	    // Example data to pass to the template
// 		$order = Order::with('transactions')->findOrFail(132);
// 		$items = $order->getOrderDetails()->getOrderItems();
//     $imagePath = asset("images/invoice-template.png"); // Example storage image
//     $html = view('test.pdf-template', compact('imagePath', 'order', 'items'))->render();

//     $pdf = SnappyPdf::loadHTML($html)->setPaper('a4', 'portrait');

//     return $pdf->download('document.pdf');
// }

	public function store(Request $request)
	{
		// Manually validate the request
		$validator = Validator::make($request->all(), [
			'images' => 'required|array',
			'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:1024',
		]);

		// Check for validation errors
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => 'Validation errors occurred.',
				'errors' => $validator->errors()->toArray(),
			], 422);
		}

		// Proceed with storing images if validation passes
		$collection = Test::create();
		$collectionId = $collection->id;
		$storagePath = "public/collections/{$collectionId}";

		$directory = storage_path("app/{$storagePath}");
		if (!file_exists($directory)) {
			mkdir($directory, 0775, true);
		}

		$imageFilenames = [];
		foreach ($request->file('images') as $image) {
			$originalFilename = $image->getClientOriginalName();
			$image->storeAs($storagePath, $originalFilename);
			$imageFilenames[] = $originalFilename;
		}

		$collection->images = $imageFilenames;
		$collection->save();

		// Return success response
		return response()->json([
			'success' => true,
			'message' => 'Images uploaded successfully!',
			'collection_id' => $collectionId,
			'images' => $imageFilenames,
		]);
	}


		

    public function remove($filename)
    {
        if (Storage::disk('public')->exists('uploads/' . $filename)) {
            Storage::disk('public')->delete('uploads/' . $filename);
            return response()->json(['message' => 'File deleted'], 200);
        }

        return response()->json(['message' => 'File not found'], 404);
    }
    public function invoice()
	{
		$order = Order::with('transactions')->findOrFail(140);

		$order->getOrderDetails()->calculateTotals();
		$items = $order->getOrderDetails()->getOrderItems();
		// $siteSetting = SiteSetting::first();
// return $siteSetting;
		// $id = 140;

		return view('test.invoice-template', compact('order', 'items',));
	}

    public function create()
	{
		return view('test.new-file-upload');
	}

    public function devF()
	{
		return view('test.devF-image-uploader');
	}

	
}
