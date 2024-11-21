<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use Storage;
use Auth;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function profile()
	{
		$reviews = Review::where('user_id', auth()->id())
			->orderBy('created_at', 'desc')
			->get();

		// return $reviews;
		$user = Auth::user();
		$orders = $user->orders()->whereIn('status', [2, 3])->get(); // Fetch all orders related to the authenticated user
		// return $orders;
		
		return view('backEnd.user.index', compact('user', 'orders', 'reviews'));
	}

	public function update(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
			'phone' => 'nullable|string|max:20',
			'city' => 'nullable|string|max:255',
			'zone' => 'nullable|string|max:255',
			'area' => 'nullable|string|max:255',
			'country' => 'nullable|string|max:255',
			'zip' => 'nullable|string|max:10',
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);

		// Get the authenticated user
		$user = auth()->user();

		// Update user attributes from validated data
		$user->fill($validated);

		// Handle avatar upload
		if ($request->hasFile('avatar')) {
			// Check if a previous avatar exists and delete it
			if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
				Storage::disk('public')->delete('avatars/' . $user->avatar);
			}

			// Generate a meaningful filename and store the new avatar
			$filename = 'user_' . $user->id . '_' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
			$avatarPath = $request->file('avatar')->storeAs('avatars', $filename, 'public');
			$user->avatar = $filename; // Update avatar field with new filename
		}

		// Save the user profile
		$user->save();


		return redirect()->route('profile')->with('success', 'Profile updated successfully!');
	}


}
