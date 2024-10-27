<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



class SuccessOrderAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

	public function handle($request, Closure $next)
	{
		// Initialize or increment the refresh counter
		$refreshCount = $request->session()->get('refresh_count', 0);
	
		// Increment the refresh count
		$refreshCount++;
		$request->session()->put('refresh_count', $refreshCount);
	
		// Check if the user is authenticated
		if (Auth::check()) {
			// Reset the refresh counter if the user is logged in
			$request->session()->forget('refresh_count');
			return $next($request);
		}
	
		// Check if the session variable for order_ref exists
		if ($request->session()->has('order_ref')) {
			// Check if the refresh limit is reached
			if ($refreshCount >= 5) {
				// Destroy the order_ref session variable after 5 refreshes
				$request->session()->forget('order_ref');
				$request->session()->forget('refresh_count'); // Optionally clear the refresh count
				
				// Set the message in the session
				session()->flash('error', 'Your Session is over! You need to register/login with your order email to view the order.');
	
				// Redirect to the login page
				return redirect()->route('register');
			}
			return $next($request); // Allow the request to proceed if the limit has not been reached
		}
	
		// Set the message for not logged in users
		session()->flash('error', 'Unauthorized Access! You need to register/login with your order email to view the order.');
	
		// Redirect to the login page
		return redirect()->route('register');
	}
}
