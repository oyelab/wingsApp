<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
	public function getInTouch()
	{
		return view('frontEnd.pages.getInTouch');
	}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		// Fetch all pages from the database
        $pages = Page::all();

        // Pass the pages to the view
        return view('frontEnd.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        // Fetch a single page by ID
        $page = Page::findOrFail($page);

        // Return the individual page view
        return view('frontEnd.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
