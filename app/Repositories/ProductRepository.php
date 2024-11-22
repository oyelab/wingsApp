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
		return Product::whereHas('categories', function ($query) {
			$query->where('slug', '!=', 'wings-edited');
		})
		->latest()
		->take($limit)
		->get();
	}
	

	public function getTopOrders($limit = 8)
	{
		return Product::whereHas('categories', function ($query) {
			$query->where('slug', '!=', 'wings-edited'); // Exclude products from the 'wings-edited' category
		})
		->topOrders()
		->take($limit)
		->get();
	}
	

	public function getMostViewed($limit = 8)
	{
		return Product::whereHas('categories', function ($query) {
			$query->where('slug', '!=', 'wings-edited'); // Exclude products from the 'wings-edited' category
		})
		->mostViewed()
		->take($limit)
		->get();
	}
	
   
	public function getOfferProducts($limit = 8)
	{
		return Product::whereHas('categories', function ($query) {
			$query->where('slug', '!=', 'wings-edited'); // Exclude products from the 'wings-edited' category
		})
		->offerProducts()
		->take($limit)
		->get();
	}
	

	public function getTrending($limit = 8)
	{
		return Product::whereHas('categories', function ($query) {
			$query->where('slug', '!=', 'wings-edited'); // Exclude products from the 'wings-edited' category
		})
		->trending()
		->take($limit)
		->get();
	}
	

	public function getBulks()
	{
		return Product::whereHas('categories', function ($query) {
			$query->where('slug', '!=', 'wings-edited'); // Exclude products from the 'wings-edited' category
		})
		->bulks()
		->get();
	}
	
}
