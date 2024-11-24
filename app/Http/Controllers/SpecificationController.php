<?php

namespace App\Http\Controllers;

use App\Models\Specification;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SpecificationController extends Controller
{
	public function store(Request $request)
	{
		$specification = Specification::create([
			'item' => $request->item,
		]);
	
		return response()->json(['id' => $specification->id]);
	}
	
	public function update(Request $request)
	{
		$specification = Specification::findOrFail($request->id);
		$specification->update([
			'item' => $request->item,
		]);

		
	
		return response()->json(['success' => true]);
	}
	
	public function destroy(Request $request)
	{
		$specification = Specification::findOrFail($request->id);
		$specification->delete();
	
		return response()->json(['success' => true]);
	}

    /**
     * Display a listing of the resource.
     */
	public function index()
	{
		// Fetch all specifications from the database
		$specifications = Specification::all();
	
		// Pass the specifications to the view
		return view('backEnd.specifications.index', compact('specifications'));
	}
	
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.specifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Display the specified resource.
     */
    public function show(Specification $specification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specification $specification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   
}
