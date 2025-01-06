<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use Storage;
use Auth;
use App\Services\FileHandlerService;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

	protected $fileHandler;

	public function __construct(FileHandlerService $fileHandler)
    {
		$this->fileHandler = $fileHandler;

        $this->middleware('auth');
		// $this->middleware('role'); // Only allow role 1 users
    }

	public function customerList(Request $request)
	{
		if ($request->ajax()) {
			// Fetch customers with order count and review count, and order by orders_count
			$customers = User::withCount(['orders', 'reviews']) // Fetch both orders and reviews counts
				->orderByDesc('orders_count') // Sort by orders_count in descending order
				->get();
	
			return DataTables::of($customers)
				->addColumn('ordersCount', function($row) {
					return $row->orders_count; // Add the orders_count to the column
				})
				->addColumn('reviewsCount', function($row) {
					return $row->reviews_count; // Add the reviews_count to the column
				})
				->make(true);
		}
	
		return view('backEnd.user.customers');
	}
	
	public function userOrders()
	{
		// Get the currently authenticated user
		$user = Auth::user();

		// Retrieve all orders for the authenticated user
		$orders = $user->orders; // Assuming 'orders' is a relationship defined in the User model

		// Loop through the orders and calculate totals
		foreach ($orders as $order) {
			// Call the calculateTotals() method to populate order totals
			$order->calculateTotals();
		}
	
		return view('backEnd.user.orders', compact('orders'));
	}
	
    public function profile()
	{
		$reviews = Review::where('user_id', auth()->id())
			->where('status', true) // Only fetch reviews with status = true
			->orderBy('created_at', 'desc')
			->get();

		// return $reviews;
		$user = Auth::user();
		$orders = $user->orders()->whereIn('status', [2, 3])->get(); // Fetch all orders related to the authenticated user
		
		// Loop through the orders and calculate totals
		foreach ($orders as $order) {
			// Call the calculateTotals() method to populate order totals
			$order->calculateTotals();
		}
		
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
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
		]);

		// Get the authenticated user
		$user = auth()->user();

		// Update user attributes from validated data
		$user->fill($validated);

		// If a new file is uploaded, handle it
		if ($request->hasFile('avatar')) {
			// Delete the old file if it exists
			$this->fileHandler->deleteFile("avatars/{$user->avatar}");

			// Store the new image and get the filename
			$user->avatar = $this->fileHandler->storeFile($request->file('avatar'), 'avatars');
		}

		// Save the updated slider
		$user->save();


		return redirect()->route('profile')->with('success', 'Profile updated successfully!');
	}


}
