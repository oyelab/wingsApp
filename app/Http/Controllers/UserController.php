<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function profile()
	{
		$user = Auth::user();
		$orders = $user->orders()->whereIn('status', [2, 3])->get(); // Fetch all orders related to the authenticated user
		// return $orders;
		
		return view('backEnd.user.index', compact('user', 'orders'));
	}
}
