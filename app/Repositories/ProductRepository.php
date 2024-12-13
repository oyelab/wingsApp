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
		return Product::with('categories') // Eager load categories
			->whereHas('categories', function ($query) {
				$query->where('slug', '!=', 'wings-edited');
			})
			->where('status', 1)
			->latest()
			->paginate($limit);
	}

	
	public function getTopOrders($limit = 8)
	{
		return Product::with('categories') // Eager load categories
			->whereHas('categories', function ($query) {
				$query->where('slug', '!=', 'wings-edited'); // Exclude products from the 'wings-edited' category
			})
			->where('status', 1)
			->topOrders()
			->paginate($limit);
	}

	public function getMostViewed($limit = 8)
	{
		return Product::with('categories') // Eager load categories
			->whereHas('categories', function ($query) {
				$query->where('slug', '!=', 'wings-edited');
			})
			->where('status', 1)
			->mostViewed()
			->paginate($limit);
	}

	public function getOfferProducts($limit = 8)
	{
		return Product::with('categories') // Eager load categories
			->whereHas('categories', function ($query) {
				$query->where('slug', '!=', 'wings-edited');
			})
			->where('status', 1)
			->offerProducts()
			->paginate($limit);
	}

	public function getTrending($limit = 8)
	{
		return Product::with('categories') // Eager load categories
			->whereHas('categories', function ($query) {
				$query->where('slug', '!=', 'wings-edited');
			})
			->where('status', 1)
			->trending()
			->paginate($limit);
	}
	

	public function getBulks($limit = 8)
	{
		return Product::bulks()
			->where('status', 1)
			->paginate($limit);
	}
	
}
