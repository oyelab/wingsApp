<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Order;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;





class TestController extends Controller
{
	public function test()
	{
		$product = Product::with('categories')->find(67);
		return $product;

		// Get the subcategory (based on category_parent_id)
		// $subcategory = $product->category;  // This is the subcategory (e.g., Football)
	}
	public function generatePdf(Order $order)
	{
		// $siteSettings = SiteSetting::first(); 

		// Example data to pass to the template
		// $order = Order::with('transactions')->findOrFail(136);
		// return $order;
		$order->getOrderDetails()->calculateTotals();

		$items = $order->getOrderItems();
		// return $items;
	
		// Pass variables to the Blade template
		// return view('test.pdf-template', compact('order', 'items', 'siteSettings'));
		$html = View::make('test.pdf-template', compact('order', 'items', ))->render();
	
		// Configure mPDF
		$mpdf = new Mpdf([
			'mode' => 'utf-8',
			'format' => 'A4',
		]);
	
		// Load the HTML content into mPDF
		$mpdf->WriteHTML($html);
	
		// Output the PDF as a downloadable file
		return $mpdf->Output($order->ref . '.pdf', 'D'); // 'D' forces a download; use 'I' to display in-browser
	}
	

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
		$storagePath = "public/devFImg/{$collectionId}";

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
