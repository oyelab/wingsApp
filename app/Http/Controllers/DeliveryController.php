<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\Delivery;
use App\Services\OrderService;
use Log;


class DeliveryController extends Controller
{

	protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
		$this->middleware('auth')->except('calculateShipping', 'fetchCities', 'fetchZones', 'fetchAreas', 'fetchStores');
		$this->middleware('role')->except('calculateShipping', 'fetchCities', 'fetchZones', 'fetchAreas', 'fetchStores');
    }

	public function calculateShipping(Request $request)
	{
		$recipientCity = $request->input('recipient_city');
		$recipientZone = $request->input('recipient_zone');
		$quantity = $request->input('quantity');
	
		$response = Http::withHeaders([
			'Authorization' => "Bearer " . env('PATHAO_ACCESS_TOKEN'),
			'Accept' => 'application/json',
			'Content-Type' => 'application/json',
		])->post(env('PATHAO_BASE_URL') . '/aladdin/api/v1/merchant/price-plan',

		[
			'store_id' => '133730',
			'item_type' => 2,
			'delivery_type' => 48,
			'item_weight' => 0.250 * $quantity,
			'recipient_city' => $recipientCity,
			'recipient_zone' => $recipientZone,
		]);

	
		return response()->json($response->json(), $response->status());
	}

	public function fetchCities()
	{
		try {
			$cities = $this->orderService->fetchFromApi('aladdin/api/v1/city-list');
			return response()->json($cities);
		} catch (\Exception $e) {
			return response()->json(['error' => $e->getMessage()], 500);
		}
	}

	public function fetchZones($cityId)
	{
		try {
			$zones = $this->orderService->fetchFromApi("aladdin/api/v1/cities/{$cityId}/zone-list");
			return response()->json($zones);
		} catch (\Exception $e) {
			return response()->json(['error' => $e->getMessage()], 500);
		}
	}

	public function fetchAreas($zoneId)
	{
		try {
			$areas = $this->orderService->fetchFromApi("aladdin/api/v1/zones/{$zoneId}/area-list");
			return response()->json($areas);
		} catch (\Exception $e) {
			return response()->json(['error' => $e->getMessage()], 500);
		}
	}

	public function fetchStores(Request $request)
	{
		try {
			$stores = $this->orderService->fetchFromApi('aladdin/api/v1/stores');
			return response()->json($stores);
		} catch (\Exception $e) {
			return response()->json(['error' => $e->getMessage()], 500);
		}
	}


	public function createStores(Request $request)
	{
		$accessToken = env('PATHAO_ACCESS_TOKEN_TEST'); // Get the access token from the .env file
		$baseUrl = env('PATHAO_BASE_URL_TEST'); // Make sure you set this in your .env file

		try {
			$response = Http::withHeaders([
				'Authorization' => "Bearer {$accessToken}",
				'Content-Type' => 'application/json',
				'Accept' => 'application/json',
			])->get("{$baseUrl}/aladdin/api/v1/stores");

			// Return the response in JSON format
			return response()->json($response->json());
		} catch (\Exception $e) {
			return response()->json(['message' => 'Failed to fetch stores.'], 500);
		}
	}
	

	public function createOrder(Request $request)
	{
		// return $request;
		// Validate the incoming request data
		$request->validate([
			'recipient_name' => 'required|string',
			'recipient_phone' => 'required|string',
			'recipient_address' => 'required|string',
			'recipient_city' => 'required|string',
			'recipient_zone' => 'required|string',
			'recipient_area' => 'nullable|string',
			'item_quantity' => 'required|integer',
			'item_weight' => 'required|numeric',
			'amount_to_collect' => 'required|numeric',
			'special_instruction' => 'nullable|string',
			'item_description' => 'nullable|string',
		]);
	
		// Prepare the request body for the API call
		$requestBody = [
			'store_id' => '147848',
			'merchant_order_id' => $request->order_ref,
			'recipient_name' => $request->recipient_name,
			'recipient_phone' => $request->recipient_phone,
			'recipient_address' => $request->recipient_address,
			'recipient_city' => $request->recipient_city,
			'recipient_zone' => $request->recipient_zone,
			'recipient_area' => $request->recipient_area,
			'delivery_type' => 48,
			'item_type' => 2,
			'special_instruction' => $request->special_instruction,
			'item_quantity' => $request->item_quantity,
			'item_weight' => $request->item_weight,
			'amount_to_collect' => $request->amount_to_collect,
			'item_description' => $request->item_description,
		];

		// return $requestBody;
	
		// Send the request to create the order
		$response = $this->orderService->createOrder($requestBody);

		// return $response;
		
	
		// Check the response status and proceed based on the success of the response
		if ($response->successful()) {
			// Retrieve the order reference ID and find the order to update the status
			$orderRef = $response['data']['merchant_order_id'];
			$order = Order::where('ref', $orderRef)->first();
	
			if ($order) {
				$order->status = 3; // Set status to 3
				$order->save();
			}
	
			// Retrieve the associated delivery or create a new instance if not found
			$delivery = $order->delivery ?: new Delivery(['order_id' => $order->id]);
	
			// Update specific fields dynamically
			$delivery->fill([
				'consignment_id' => $response['data']['consignment_id'] ?? $delivery->consignment_id,
				'delivery_fee' => $response['data']['delivery_fee'] ?? $delivery->delivery_fee,
				'recipient_city' => $request->recipient_city ?? $delivery->recipient_city,
				'recipient_zone' => $request->recipient_zone ?? $delivery->recipient_zone,
				'recipient_area' => $request->recipient_area ?? $delivery->recipient_area,
				'special_instruction' => $request->special_instruction ?? $delivery->special_instruction,
				'item_description' => $request->item_description ?? $delivery->item_description,
			]);
	
			// Save the updated or new delivery record
			$order->delivery()->save($delivery);
			// Before redirecting
	
			return redirect()->route('orders.index')->with('response', $response->json());


			

		} else {
			// Handle the error and redirect back
			return redirect()->back()->with('response', $response->json());
		}
		
	}
	
	

	public function issueTokenGenerate()
	{
		return view('test.issue-token');
	}
    public function issueToken(Request $request)
    {
       // Validate the incoming request data
		$request->validate([
			'client_id' => 'required|string',
			'client_secret' => 'required|string',
			'username' => 'required|email',
			'password' => 'required|string',
			'grant_type' => 'required|string',
		]);

		// Prepare the request body
		$requestBody = [
			'client_id' => $request->client_id,
			'client_secret' => $request->client_secret,
			'username' => $request->username,
			'password' => $request->password,
			'grant_type' => $request->grant_type,
		];

		// Get the base URL from the config
		$baseUrl = config('pathao.base_url');

		// Make the POST request to issue the token
		$response = Http::withHeaders([
			'Accept' => 'application/json',
			'Content-Type' => 'application/json',
		])->post("{$baseUrl}/aladdin/api/v1/issue-token", $requestBody);  // Use $baseUrl

		// Check the response status and return the appropriate response
		if ($response->successful()) {
			// Token issued successfully
			return response()->json($response->json());
		} else {
			// Handle errors
			return response()->json([
				'error' => 'Unable to issue token',
				'message' => $response->json(),
			], $response->status());
		}
    }

    

}

