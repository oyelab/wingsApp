<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function calculateBaseFair($products)
    {
        return collect($products)->sum(fn($product) => 
            Product::find($product['id'])->price * $product['quantity']
        );
    }

    public function calculateDiscountAmount($products)
    {
        return collect($products)->sum(fn($product) => 
            (Product::find($product['id'])->price * $product['quantity']) * (Product::find($product['id'])->sale / 100)
        );
    }
}
