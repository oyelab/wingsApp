<?php

// app/Services/OrderService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\SiteSetting;

class OrderService
{
    protected $baseUrl;
    protected $accessToken;

    public function __construct($baseUrl, $accessToken)
    {
        $this->baseUrl = rtrim($baseUrl, '/'); // Ensure there's no trailing slash
        $this->accessToken = $accessToken;
    }

    public function createOrder(array $requestBody)
    {
        $response = Http::withHeaders($this->getHeaders())->post("{$this->baseUrl}/aladdin/api/v1/orders", $requestBody);
        return $response; // Return the response
    }

    protected function getHeaders()
    {
        // Always get the latest token from database
        $latestToken = SiteSetting::getPathaoAccessToken();
        $token = $latestToken ?: $this->accessToken; // Fallback to constructor token if database is empty

        return [
            'Authorization' => "Bearer {$token}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

	// public function shippingPriceCalculation($recipientCity, $recipientZone)
    // {
    //     $response = Http::withHeaders($this->getHeaders())
    //         ->post("{$this->baseUrl}/aladdin/api/v1/merchant/price-plan", [
    //             'store_id' => "147865",           // Replace with actual store ID
    //             'item_type' => "Sports Apparels",       // Replace with actual parcel type
    //             'delivery_type' => 48,
    //             'item_weight' => 0.5,
    //             'recipient_city' => $recipientCity,
    //             'recipient_zone' => $recipientZone,
    //         ]);

    //     if ($response->successful()) {
    //         return $response->json()['data']['shipping_price'] ?? 0;
    //     } else {
    //         throw new \Exception('Failed to calculate shipping price: ' . $response->status());
    //     }
    // }

    // New method to fetch data from the API
    public function fetchFromApi($endpoint)
    {
        $response = Http::withHeaders($this->getHeaders())->get("{$this->baseUrl}/{$endpoint}");

        if ($response->successful()) {
            return $response->json()['data'] ?? [];
        } else {
            throw new \Exception('Failed to fetch data from API: ' . $response->status());
        }
    }
}
