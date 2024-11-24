<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
	// Method to apply voucher
	public function applyVoucher(Request $request)
	{
		$voucherCode = $request->input('voucher');
		$voucher = Voucher::where('code', $voucherCode)->first();

		if ($voucher) {
			// Get cart items from session
			$cartItems = session('cart', []); // Assuming cart items are stored in session

			// Calculate the total quantity of all items in the cart
			$totalQuantity = collect($cartItems)->sum('quantity');
			
			// Calculate the number of unique products in the cart
			$uniqueProducts = collect($cartItems)->unique('product_id')->count();

			// Check if the total quantity meets the min_quantity requirement and unique products don't exceed the max_product
			if ($totalQuantity >= $voucher->min_quantity && $uniqueProducts <= $voucher->max_product) {
				// Store voucher code and discount in session
				session([
					'voucher_success' => true,
					'applied_voucher' => $voucher->code,
					'voucher' => $voucher->discount,
				]);

				return redirect()->route('cart.show');
			} else {
				// Either quantity or product requirement not met
				$errorMessages = [];

				if ($totalQuantity < $voucher->min_quantity) {
					$errorMessages[] = "Order minimum of {$voucher->min_quantity} products to avail this voucher!";
				}

				if ($uniqueProducts > $voucher->max_product) {
					$errorMessages[] = "Select maximum of {$voucher->max_product} products to avail this voucher!";
				}

				// Combine the error messages
				return redirect()->route('cart.show')->with([
					'error' => implode(' ', $errorMessages)
				]);
			}
		} else {
			// Voucher not valid
			return redirect()->route('cart.show')->with([
				'error' => 'Invalid voucher code.'
			]);
		}
	}




	// Method to edit voucher (show input again for editing)
	public function editVoucher()
	{
		// Allow the user to edit the voucher by showing the input again
		session()->forget('voucher_success'); // Reset the success flag
		return redirect()->route('cart.show');
	}

	// Method to remove voucher
	public function removeVoucher()
	{
		// Remove voucher from session and redirect back
		session()->forget(['voucher_success', 'applied_voucher', 'voucher']);
		return redirect()->route('cart.show');
	}


	public function __construct()
    {
        $this->middleware('auth')->except('applyVoucher', 'editVoucher', 'removeVoucher');
		$this->middleware('role')->except('applyVoucher', 'editVoucher', 'removeVoucher');; // Only allow role 1 users
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::get();

		return $vouchers;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$validatedData = $request->validate([
			'code' => 'required|unique:vouchers,code',
			'discount' => 'required|integer|min:1|max:100',
			'criteria' => 'required|json',  // Ensure criteria is valid JSON
		]);
	
		// Decode the criteria JSON to an array
		$criteria = json_decode($request->input('criteria'), true);
	
		$voucher = Voucher::create([
			'code' => $request->input('code'),
			'discount' => $request->input('discount'),
			'criteria' => $criteria,  // Store the criteria as a JSON array
			'status' => $request->input('status'),  // Example field for status
		]);

		// return $voucher;
	
		return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
