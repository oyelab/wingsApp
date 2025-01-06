<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Git;
use App\Models\TypeList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Services\FileHandlerService;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{

	protected $fileHandler;

	public function __construct(FileHandlerService $fileHandler)
    {

		$this->fileHandler = $fileHandler;

        $this->middleware('auth')->except('getInTouch', 'postInTouch', 'help');
		$this->middleware('role')->except('getInTouch', 'postInTouch', 'help');
    }

	public function getInTouch()
	{
		return view('frontEnd.pages.getInTouch');
	}

	public function postInTouch(Request $request)
	{
		// Validate the form data
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|max:255',
			'subject' => 'required|string|max:255',
			'message' => 'required|string',
		]);
	
		// Get the user's IP address
		$ipAddress = $request->ip();
	
		// Get the user agent from the request
		$userAgent = $request->header('User-Agent');
	
		// Store the validated data, IP address, and user agent in the database
		Git::create([
			'name' => $validated['name'],
			'email' => $validated['email'],
			'subject' => $validated['subject'],
			'message' => $validated['message'],
			'user_agent' => $userAgent,
			'ip_address' => $ipAddress, // Store IP address
		]);
	
		// Redirect to a page (for example, to a confirmation page or the dashboard)
		return back()->with('success', 'Thank you for contacting us! You will be replied soon.');
	}

    /**
     * Display a listing of the resource.
     */

    public function help()
    {
		// Fetch all pages from the database
		$pages = Page::where('type', '!=', 4)->orderBy('order', 'asc')->get();

        // Pass the pages to the view
        return view('frontEnd.pages.index', compact('pages'));
    }

	public function index()
    {
		// Fetch all pages from the database
        $pages = Page::orderBy('order', 'asc')->get();

		// Fetch the asset types from the 'type_lists' table where 'table' is 'assets'
		$typeList = TypeList::where('table', 'pages')->first();

		// Directly access the 'items' field, which is already cast to an array
		$menuTypes = $typeList ? $typeList->items : [];

        // Pass the pages to the view
        return view('backEnd.pages.index', compact('pages', 'menuTypes'));
    }

	public function show(Page $page)
    {
        // Fetch a single page by ID
        $page = Page::findOrFail($page);
		return $page;

        // Return the individual page view
        // return view('frontEnd.page.show', compact('page'));
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
			'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
			'content' => 'nullable|string',
		]);
	
		// Generate the slug
		$slug = Str::slug($request->title);
	
	
		$filename = $this->fileHandler->storeFile($request->file('image'), 'pages');  // 'sliders' is the directory
	
		// Create a new page entry in the database
		Page::create([
			'title' => $request->title,
			'image' => $filename,  // Store the unique path to the image
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
		
		// return $page->image;

		return view('backEnd.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
	{
		// Validate the form data
		$request->validate([
			'title' => 'required|string|max:255|unique:pages,title,' . $id, // Exclude the current page from unique check
			'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
			'content' => 'nullable|string',
		]);

		// Find the page by ID
		$page = Page::findOrFail($id);

		// Generate the slug
		$slug = Str::slug($request->title);

			// Update the slider fields
		$page->fill($request->only(['title', 'slug', 'content']));

		// If a new file is uploaded, handle it
		if ($request->hasFile('image')) {
			// Delete the old file if it exists
			$this->fileHandler->deleteFile("pages/{$page->image}");

			// Store the new image and get the filename
			$page->image = $this->fileHandler->storeFile($request->file('image'), 'pages');
		}

		// Save the updated slider
		$page->save();

		// Redirect with success message
		return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
	}



	public function updateType(Request $request, Page $page)
	{
		// Validate the incoming request
		$request->validate([
			'type' => 'nullable|integer|in:0,1,2,3,4,5', // Allow values 0, 1, or 2
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
		// Check if the image exists and delete it using Storage
		if (Storage::disk('public')->exists('pages/' . $page->image)) {
			Storage::disk('public')->delete('pages/' . $page->image);
		}

		// Delete the slider record from the database
		$page->delete();

		// Redirect back to the index page with a success message
		return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
	}

}
