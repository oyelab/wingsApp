<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PageController extends Controller
{
	public function getInTouch()
	{
		return view('frontEnd.pages.getInTouch');
	}
    /**
     * Display a listing of the resource.
     */

    public function help()
    {
		// Fetch all pages from the database
        $pages = Page::all();

        // Pass the pages to the view
        return view('frontEnd.pages.index', compact('pages'));
    }

	public function index()
    {
		// Fetch all pages from the database
        $pages = Page::orderBy('order', 'asc')->get();

		$menuTypes = [
			1 => 'Footer Menu 1',
			2 => 'Footer Menu 2',
		];

        // Pass the pages to the view
        return view('backEnd.pages.index', compact('pages', 'menuTypes'));
    }

	public function show(Page $page)
    {
        // Fetch a single page by ID
        $page = Page::findOrFail($page);

        // Return the individual page view
        return view('frontEnd.page.show', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Page $page)
    {
		return view('backEnd.pages.create'); // Ensure this points to the correct Blade view file

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
	{
		// Validate the form data
		$request->validate([
			'title' => 'required|string|max:255|unique:pages,title',
			'content' => 'required|string',
		]);

		// Generate the slug
		$slug = Str::slug($request->title);

		// Create a new page
		Page::create([
			'title' => $request->title,
			'content' => $request->content,
			'slug' => $slug,
		]);

		// Redirect with success message
		return redirect()->route('pages.index')->with('success', 'Page created successfully.');
	}

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
		return view('backEnd.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
			'type' => 'nullable|integer|in:0,1,2', // Allow 0 (none), 1 (Footer Menu 1), and 2 (Footer Menu 2)

        ]);

		// Generate a base slug
		$baseSlug = Str::slug($request->title, '-');
		$slug = $baseSlug;

		// Check for existing slugs and append a unique identifier if needed
		$existingSlugs = Page::where('slug', 'like', "{$baseSlug}%")->pluck('slug');

		if ($existingSlugs->contains($slug)) {
			$count = 1;
			while ($existingSlugs->contains("{$baseSlug}-{$count}")) {
				$count++;
			}
			$slug = "{$baseSlug}-{$count}";
		}

        // Update page with form data
        $page->update([
            'title' => $request->title,
			'slug' => $slug,
			'content' => $request->content,
			'type' => $request->type,

        ]);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully');
    }

	public function updateType(Request $request, Page $page)
	{
		// Validate the incoming request
		$request->validate([
			'type' => 'nullable|integer|in:0,1,2', // Allow values 0, 1, or 2
		]);

		// Update only the 'type' field
		$page->update([
			'type' => $request->type,
		]);

		// Redirect back with success message
		return redirect()->route('pages.index')->with('success', 'Page type updated successfully.');
	}

	public function updateOrder(Request $request)
	{
		$order = $request->order;

		// Loop through the order array and update each page's order
		foreach ($order as $index => $pageData) {
			$page = Page::find($pageData['id']);
			$page->update(['order' => $pageData['order']]);
		}

		return response()->json(['success' => true]);
	}



    /**
     * Remove the specified resource from storage.
     */

	public function destroy(Page $page)
	{
		// Delete the page
		$page->delete();

		// Redirect back to the index page with a success message
		return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
	}

}
