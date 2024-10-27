<?php

namespace App\Http\Controllers;

use App\Models\AdminOrder;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		
        return view('backEnd.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontEnd.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'delivery_method' => 'required|string|in:cod,online_payment',
            'courier_charge' => 'nullable|numeric', // only applicable for COD
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|string|in:sslcommerz,cod',
        ]);

        // Handle conditional fields based on delivery method
        $courierCharge = $request->input('delivery_method') === 'cod' ? $request->input('courier_charge', 0) : 0;

        // Create the order
        $order = new AdminOrder();
        $order->name = $validatedData['name'];
        $order->address = $validatedData['address'];
        $order->email = $validatedData['email'];
        $order->phone = $validatedData['phone'];
        $order->delivery_method = $validatedData['delivery_method'];
        $order->courier_charge = $courierCharge;
        $order->total_amount = $validatedData['total_amount'];
        $order->payment_method = $validatedData['payment_method'];

        // Save the order to the database
        $order->save();

        // Redirect to a success page or return a response
        return redirect()->route('order.success')->with('success', 'Your order has been successfully placed!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminOrder $adminOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminOrder $adminOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminOrder $adminOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminOrder $adminOrder)
    {
        //
    }
}
