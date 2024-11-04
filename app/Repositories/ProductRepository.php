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

	 public function getLatestProducts($limit = 8)
    {
        return Product::latestProducts()->take($limit)->get();
    }

    public function getTopOrders($limit = 8)
    {
        return Product::topOrders()->take($limit)->get();
    }

    public function getMostViewed($limit = 8)
    {
        return Product::mostViewed()->take($limit)->get();
    }
   
	public function getOfferProducts($limit = 8)
    {
        return Product::offerProducts()->take($limit)->get();
    }

    public function getTrending($limit = 8)
    {
        return Product::trending()->take($limit)->get();
    }
}
