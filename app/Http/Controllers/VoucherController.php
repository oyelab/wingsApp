<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\Validator;


class VoucherController extends Controller
{

	public function applyVoucher(Request $request)
	{
		// Validate the input
		$validator = Validator::make($request->all(), [
			'voucher' => [
				'required',
				'exists:vouchers,code',
				function ($attribute, $value, $fail) {
					$voucher = Voucher::where('code', $value)->first();
					if ($voucher && !$voucher->status) {
						$fail('The voucher has expired.');
					}
				},
			],
		], [
			'voucher.required' => 'Please enter a voucher code.',
			'voucher.exists' => 'The voucher code entered is invalid.',
		]);

		if ($validator->fails()) {
			return redirect()->route('cart.show')
				->withErrors($validator)
				->withInput();
		}

		// Retrieve the validated voucher
		$voucherCode = $request->input('voucher');
		$voucher = Voucher::where('code', $voucherCode)->first();

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

			return redirect()->route('cart.show')->with('success', 'Voucher applied successfully.');
		} else {
			// Either quantity or product requirement not met
			$errorMessages = [];

			if ($totalQuantity < $voucher->min_quantity) {
				$errorMessages[] = "Order minimum of {$voucher->min_quantity} products to avail this voucher!";
			}

			if ($uniqueProducts > $voucher->max_product) {
				$errorMessages[] = "Select maximum of {$voucher->max_product} products to avail this voucher!";
			}

			// Store the error messages as an array in the session
			return redirect()->route('cart.show')->withErrors($errorMessages);
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
		$vouchers = Voucher::all(); // Retrieve all voucher data from the database
	
		return view('backEnd.vouchers.index', compact('vouchers')); // Pass vouchers to the view
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
		$request->validate([
			'code' => 'required|string|max:255|unique:vouchers,code',
			'discount' => 'required|integer|min:0|max:100',
			'max_product' => 'required|integer|min:1',
			'min_quantity' => 'required|integer|min:1',
			'status' => 'required|boolean',
		]);
	
		$voucher = Voucher::create([
			'code' => $request->code,
			'discount' => $request->discount,
			'max_product' => $request->max_product,
			'min_quantity' => $request->min_quantity,
			'status' => $request->status,
		]);
	
		return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully');
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
		$voucher = Voucher::findOrFail($id);
        return view('backEnd.vouchers.partials.voucherEdit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
	// Update the voucher in the database
	public function update(Request $request, $id)
	{
		// return $request;
		$request->validate([
			'code' => 'required|string|max:255|unique:vouchers,code,' . $id,
			'discount' => 'required|integer|min:0',
			'max_product' => 'required|integer|min:1',
			'min_quantity' => 'required|integer|min:1',
			'status' => 'required|boolean',
		]);

		$voucher = Voucher::findOrFail($id);
		$voucher->update($request->all()); // Update the voucher record

		return redirect()->route('vouchers.index')->with('success', 'Voucher updated successfully');
	}

    /**
     * Remove the specified resource from storage.
     */
	// Delete the voucher from the database
	public function destroy($id)
	{
		$voucher = Voucher::findOrFail($id);
		$voucher->delete(); // Delete the voucher

		return redirect()->route('vouchers.index')->with('success', 'Voucher deleted successfully');
	}
}
