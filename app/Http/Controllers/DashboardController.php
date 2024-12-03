<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function root()
    {
		$year = now()->year; // Default to the current year

		// Get the total sales volume and monthly sales
		$totalSalesVolume = Order::totalSalesVolume($year);
		$monthlySales = Order::getMonthlySales($year);
	
		// Get the total number of completed orders
		$totalOrders = Order::getMonthlyOrders($year);
		// return $totalOrders;

		// Accessing the total count
		$totalOrdersCount = $totalOrders['total'];

		// return $totalOrdersCount;
		
		// Accessing the monthly counts
		$monthlyOrdersCounts = $totalOrders['monthly'];
		// return $monthlyOrdersCounts;
				
		$popularProducts = Product::topOrders()->get(); // Fetch all popular products
		// return $popularProducts;

		 // Get users with the count of reviews they have
		 $loyalCustomers = User::withCount('reviews') // Count reviews for each user
		 ->having('reviews_count', '>', 0) // Only users who have reviews
		 ->get();

		 // Get users along with the count and average of their reviews
		 $users = User::withCount('reviews') // Count the reviews for each user
		 ->withAvg('reviews', 'rating') // Calculate the average review rating
		 ->get();

		// Filter users to only include those who have at least one review
		$loyalCustomers = $users->filter(function ($user) {
		return $user->reviews_count > 0; // Only include users with reviews
		});

		$loyalCustomers->each(function ($user) {
			$user->reviews_avg_rating = round($user->reviews_avg_rating, 1); // Round to 1 decimal place
		});

		// return $loyalCustomers;
	
		return view('backEnd.index', [
			'totalSalesVolume' => $totalSalesVolume,
			'monthlySales' => $monthlySales,
			'totalOrdersCount' => $totalOrdersCount,
			'popularProducts' => $popularProducts,
			'loyalCustomers' => $loyalCustomers,
		]);
    }

	public function getMonthlyData()
	{
		$year = now()->year; // Default to the current year

		// Fetch the monthly sales from the Order model
		$monthlySales = Order::getMonthlySales($year);
		// Fetch monthly order counts
		
		$totalOrders = Order::getMonthlyOrders($year);
		$monthlyOrders = $totalOrders['monthly'];

		return response()->json([
			'sales' => $monthlySales,
			'orders' => $monthlyOrders, 
		]);
	}
	

	



    public function index(Request $request)
    {
		if (view()->exists($request->path())) {
            return view($request->path());
        }
        return view('backEnd.errors.404');
    }
}
