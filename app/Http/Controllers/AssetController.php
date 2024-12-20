<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Services\FileHandlerService;
use App\Models\TypeList;



class AssetController extends Controller
{

	protected $fileHandler;

    // Inject the FileHandlerService
    public function __construct(FileHandlerService $fileHandler)
    {
        $this->fileHandler = $fileHandler;

		$this->middleware('auth');
		$this->middleware('role');
    }


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
		// Fetch the asset types from the 'type_lists' table where 'table' is 'assets'
		$typeList = TypeList::where('table', 'assets')->first();
		
		// Directly access the 'items' field, which is already cast to an array
		$assetTypes = $typeList ? $typeList->items : [];
	
		// Pass asset types to the view
		return view('backEnd.assets.create', compact('assetTypes'));
	}
	


	public function store(Request $request)
    {
		// return $request;
        $request->validate([
            'type' => 'required|integer',
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $asset = new Asset();
		$asset->fill($request->only(['type', 'title', 'description']));

		// Check if a file is uploaded
		if ($request->hasFile('file')) {
			$file = $request->file('file');

			// Store the file and get only the filename
			$filename = $this->fileHandler->storeFile($file, 'assets');  // 'Asset' is the directory based on your model
			
			// Save the filename in the database
			$asset->file = $filename;  // Assuming 'file_name' is a column in your 'assets' table
		}
		
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
		// Fetch the asset types from the 'type_lists' table where 'table' is 'assets'
		$typeList = TypeList::where('table', 'assets')->first();
		
		// Directly access the 'items' field, which is already cast to an array
		$assetTypes = $typeList ? $typeList->items : [];
	
		return view('backEnd.assets.edit', compact('asset', 'assetTypes'));
	}
	

    /**
     * Update the specified resource in storage.
     */
	// Update the specified asset in the database
	public function update(Request $request, Asset $asset)
	{
		$request->validate([
			'type' => 'required|integer',
			'title' => 'required|string|max:255',
			'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
			'description' => 'nullable|string',
		]);

		// Mass-assign attributes
		$asset->fill($request->only(['type', 'title', 'description']));

		// Check if a new file is uploaded
		if ($request->hasFile('file')) {
			$file = $request->file('file');

			// Delete the old file if it exists
			if ($asset->file) {
				$this->fileHandler->deleteFile("assets/{$asset->file}"); // 'assets' directory is used
			}

			// Store the new file and update the filename in the database
			$filename = $this->fileHandler->storeFile($file, 'assets');
			$asset->file = $filename; // Assuming 'file' is the column for filename
		}

		$asset->save();

		return redirect()->route('assets.index')->with('success', 'Asset updated successfully');
	}


    /**
     * Remove the specified resource from storage.
     */
	// Remove the specified asset from the database
	public function destroy(Asset $asset)
	{
		// Directly use the file path from the asset
		if ($asset->file) {
			// Use the FileHandlerService to delete the file
			$this->fileHandler->deleteFile('assets/' . $asset->file);
		}
	
		// Delete the asset from the database
		$asset->delete();
	
		// Redirect with a success message
		return redirect()->route('assets.index')->with('success', 'Asset deleted successfully');
	}

}
