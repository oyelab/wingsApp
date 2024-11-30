<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Order;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;


class TestController extends Controller
{
	public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('file');
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');

        return response()->json(['filename' => $filename], 200);
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

	
}
