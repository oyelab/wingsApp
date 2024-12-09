<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;

class TrackVisits
{
    public function handle(Request $request, Closure $next)
    {
        // Capture visitor's IP address
        $ipAddress = $request->ip();

        // Check if this IP address has already been stored in the database
        $existingVisit = Subscription::where('ip_address', $ipAddress)->first();

        // If the IP address exists in the database, skip storing visit data
        if ($existingVisit) {
            return $next($request);
        }

        // Capture user-agent details
        $userAgent = $request->header('User-Agent');
        $agent = new Agent();
        $device = $agent->device();
        $platform = $agent->platform();
        $browser = $agent->browser();

        // IP Geolocation API request
        $apiUrl = "http://ip-api.com/json/{$ipAddress}?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query";
        $response = Http::get($apiUrl)->json();

        if ($response['status'] !== 'success') {
            $country = 'Unknown';
            $city = 'Unknown';
            $lat = 0.0;
            $lon = 0.0;
            $timezone = 'Unknown';
            $isp = 'Unknown';
        } else {
            $country = $response['country'];
            $city = $response['city'];
            $lat = $response['lat'];
            $lon = $response['lon'];
            $timezone = $response['timezone'];
            $isp = $response['isp'];
        }

        // Store visit data
        Subscription::create([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'device' => $device,
            'platform' => $platform,
            'browser' => $browser,
            'country' => $country,
            'city' => $city,
            'lat' => $lat,
            'lon' => $lon,
            'timezone' => $timezone,
            'isp' => $isp,
        ]);

        return $next($request);
    }
}
