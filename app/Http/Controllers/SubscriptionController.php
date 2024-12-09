<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Subscription;
use Jenssegers\Agent\Agent;

class SubscriptionController extends Controller
{
	public function index()
	{
		// Fetch all subscriptions with pagination
		$subscriptions = Subscription::paginate(10);

		return view('subscriptions.index', compact('subscriptions'));
	}

	public function show($id)
	{
		$subscription = Subscription::findOrFail($id);
		return response()->json($subscription);
	}
	
    
	public function store(Request $request)
	{
		// Validate the email
		$validatedData = $request->validate([
			'email' => 'required|email|unique:subscriptions,email',
		]);

		// Capture user information
		$userAgent = new Agent();
		$platform = $userAgent->platform();  // OS (e.g., Windows, macOS)
		$browser = $userAgent->browser();    // Browser (e.g., Chrome, Firefox)
		$device = $userAgent->device();      // Device (e.g., mobile, desktop)
		$ipAddress = $request->ip();         // User's IP address

		// IP Geolocation API to fetch location data
		$apiUrl = "http://ip-api.com/json/{$ipAddress}?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query";
		$response = Http::get($apiUrl)->json();

		// Check if the API call was successful
		if ($response['status'] !== 'success') {
			// In case the API fails, create subscription with the available data
			return $this->createSubscription($validatedData['email'], $ipAddress, $userAgent, $platform, $browser, $device);
		}

		// Create a new subscription record with geolocation data
		Subscription::create([
			'email' => $validatedData['email'],
			'status' => $response['status'] ?? null,
			'message' => $response['message'] ?? null,
			'continent' => $response['continent'] ?? null,
			'continent_code' => $response['continentCode'] ?? null,
			'country' => $response['country'] ?? null,
			'country_code' => $response['countryCode'] ?? null,
			'region' => $response['region'] ?? null,
			'region_name' => $response['regionName'] ?? null,
			'city' => $response['city'] ?? null,
			'district' => $response['district'] ?? null,
			'zip' => $response['zip'] ?? null,
			'lat' => $response['lat'] ?? null,
			'lon' => $response['lon'] ?? null,
			'timezone' => $response['timezone'] ?? null,
			'offset' => $response['offset'] ?? null,
			'currency' => $response['currency'] ?? null,
			'isp' => $response['isp'] ?? null,
			'org' => $response['org'] ?? null,
			'as' => $response['as'] ?? null,
			'asname' => $response['asname'] ?? null,
			'reverse' => $response['reverse'] ?? null,
			'mobile' => $response['mobile'] ?? false,
			'proxy' => $response['proxy'] ?? false,
			'hosting' => $response['hosting'] ?? false,
			'query' => $response['query'] ?? null,
			'ip_address' => $ipAddress,
			'user_agent' => $request->header('User-Agent'),
			'device' => $device,
			'platform' => $platform,
			'browser' => $browser,
		]);

		// Return a success message
		return redirect()->back()->with('success', 'Thank you for subscribing!');
	}

	/**
	 * Create a subscription with only basic data (in case of API failure).
	 *
	 * @param string $email
	 * @param string $ipAddress
	 * @param object $userAgent
	 * @param string $platform
	 * @param string $browser
	 * @param string $device
	 * @return \Illuminate\Http\RedirectResponse
	 */
	private function createSubscription($email, $ipAddress, $userAgent, $platform, $browser, $device)
	{
		Subscription::create([
			'email' => $email,
			'status' => null,
			'message' => 'IP Geolocation API failed',
			'continent' => null,
			'continent_code' => null,
			'country' => null,
			'country_code' => null,
			'region' => null,
			'region_name' => null,
			'city' => null,
			'district' => null,
			'zip' => null,
			'lat' => null,
			'lon' => null,
			'timezone' => null,
			'offset' => null,
			'currency' => null,
			'isp' => null,
			'org' => null,
			'as' => null,
			'asname' => null,
			'reverse' => null,
			'mobile' => false,
			'proxy' => false,
			'hosting' => false,
			'query' => null,
			'ip_address' => $ipAddress,
			'user_agent' => $userAgent->getUserAgent(),
			'device' => $device,
			'platform' => $platform,
			'browser' => $browser,
		]);

		return redirect()->back()->with('error', 'Unable to fetch geolocation data, but subscription was successful.');
	}

}
