<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;



class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::all();  // Or paginate for large datasets
        return view('backEnd.assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		return view('backEnd.assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
	public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $asset = new Asset();
        $asset->type = $request->type;
        $asset->title = $request->title;

        if ($request->hasFile('file')) {
            $asset->file = $request->file('file'); // Automatically handled by the model's mutator
        }

        $asset->description = $request->description;
        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Asset created successfully');
    }
	

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
		return view('backEnd.assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
	// Update the specified asset in the database
	public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'type' => 'required|string',
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $asset->type = $request->type;
        $asset->title = $request->title;

        if ($request->hasFile('file')) {
            $asset->file = $request->file('file'); // Automatically handled by the model's mutator
        }

        $asset->description = $request->description;
        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
	// Remove the specified asset from the database
	public function destroy(Asset $asset)
	{
		// Delete the file from storage
		if ($asset->file && file_exists(storage_path('app/public/' . $asset->file))) {
			unlink(storage_path('app/public/' . $asset->file));
		}

		$asset->delete();

		return redirect()->route('assets.index')->with('success', 'Asset deleted successfully');
	}
}
