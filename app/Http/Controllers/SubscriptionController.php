<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Subscription;
use Jenssegers\Agent\Agent;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
		// return $request;
        // Validate the email
        $validatedData = $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

		// return $request;

        // Capture user information
        $userAgent = new Agent();
        $platform = $userAgent->platform();  // OS (e.g., Windows, macOS)
        $browser = $userAgent->browser();    // Browser (e.g., Chrome, Firefox)
        $device = $userAgent->device();      // Device (e.g., mobile, desktop)
        $ipAddress = $request->ip();      
		
		// return $ipAddress;// User's IP address

        // IP Geolocation API to fetch location data
        $apiUrl = "http://ip-api.com/json/{$ipAddress}?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query";
        $response = Http::get($apiUrl)->json();

		// return $response;

        // Check if the API call was successful
        if ($response['status'] !== 'success') {
            return redirect()->back()->with('error', 'Unable to determine location. Please try again.');
        }

        // Create a new subscription record
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
}
