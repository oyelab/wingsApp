<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Git;

class GitController extends Controller
{
	public function gits()
	{
		// Paginate the messages (10 per page in this example)
		$messages = Git::latest()->paginate(10);
	
		// Return the view with the paginated messages
		return view('backEnd.gits.index', compact('messages'));
	}
	
}
