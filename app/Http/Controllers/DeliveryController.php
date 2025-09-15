<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\SiteSetting;
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

		// Get access token from database
		$accessToken = SiteSetting::getPathaoAccessToken();
		
		// Check if access token exists
		if (!$accessToken) {
			return response()->json([
				'error' => 'Pathao access token not found. Please configure token in site settings.'
			], 500);
		}
	
		$response = Http::withHeaders([
			'Authorization' => "Bearer " . $accessToken,
			'Accept' => 'application/json',
			'Content-Type' => 'application/json',
		])->post(env('PATHAO_BASE_URL') . '/aladdin/api/v1/merchant/price-plan',

		[
			'store_id' => config('pathao.store_id'),
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
			'amount_to_collect' => 'required|numeric',
			'special_instruction' => 'nullable|string',
			'item_description' => 'nullable|string',
		]);

		$item_weight = $request->item_quantity * 0.250;
		// return $item_weight;
	
		// Prepare the request body for the API call
		$requestBody = [
			'store_id' => config('pathao.store_id'),
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
			'item_weight' => $item_weight,
			'amount_to_collect' => $request->amount_to_collect,
			'item_description' => $request->item_description,
		];

		// Log the order creation attempt
		Log::info('Pathao Order Creation Attempt', [
			'merchant_order_id' => $request->order_ref,
			'recipient_name' => $request->recipient_name,
			'recipient_phone' => $request->recipient_phone,
			'amount_to_collect' => $request->amount_to_collect,
			'request_body' => $requestBody
		]);

		// return $requestBody;
	
		// Send the request to create the order
		$response = $this->orderService->createOrder($requestBody);

		// return $response;
		
	
		// Check the response status and proceed based on the success of the response
		if ($response->successful()) {
			// Log successful order creation
			Log::info('Pathao Order Created Successfully', [
				'merchant_order_id' => $request->order_ref,
				'status_code' => $response->status(),
				'consignment_id' => $response['data']['consignment_id'] ?? 'N/A',
				'delivery_fee' => $response['data']['delivery_fee'] ?? 'N/A',
				'response_data' => $response->json()
			]);

			// Retrieve the order reference ID and find the order to update the status
			$orderRef = $response['data']['merchant_order_id'];
			$order = Order::where('ref', $orderRef)->first();
	
			if ($order) {
				$order->status = 3; // Set status to 3
				// Check for changes and update the fields
				$order->fill([
					'name' => $request->recipient_name,
					'phone' => $request->recipient_phone,
					'address' => $request->recipient_address,
				]);
	
				// Save the updated order
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
			// Log failed order creation
			Log::error('Pathao Order Creation Failed', [
				'merchant_order_id' => $request->order_ref,
				'status_code' => $response->status(),
				'error_response' => $response->json(),
				'request_data' => $requestBody,
				'recipient_name' => $request->recipient_name,
				'recipient_phone' => $request->recipient_phone,
				'amount_to_collect' => $request->amount_to_collect
			]);

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
		// Prepare the request body using config values
		$requestBody = [
			'client_id' => config('pathao.client_id'),
			'client_secret' => config('pathao.client_secret'),
			'username' => config('pathao.client_email'),
			'password' => config('pathao.client_password'),
			'grant_type' => 'password',
		];

		// Get the base URL from the config
		$baseUrl = config('pathao.base_url');

		// Make the POST request to issue the token
		$response = Http::withHeaders([
			'Accept' => 'application/json',
			'Content-Type' => 'application/json',
		])->post("{$baseUrl}/aladdin/api/v1/issue-token", $requestBody);

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

