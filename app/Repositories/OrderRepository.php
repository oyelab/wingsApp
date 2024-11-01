<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function createOrder(array $data)
    {
        return Order::create($data);
    }

    public function attachProductToOrder(Order $order, array $productData)
    {
        $order->products()->attach($productData['id'], [
            'size_id' => $productData['size_id'],
            'quantity' => $productData['quantity'],
        ]);
    }

    public function adjustProductQuantity($productId, $sizeId, $quantity)
    {
        Product::find($productId)->quantities()
            ->where('size_id', $sizeId)
            ->decrement('quantity', $quantity);
    }
}
