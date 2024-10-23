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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
