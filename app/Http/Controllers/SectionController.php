<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;

class SectionController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function shopPage($section)
    {
        switch ($section) {
            case 'latest':
                $products = $this->productRepo->getLatestProducts(20); // for example, 20 products per page
                break;
            case 'top-picks':
                $products = $this->productRepo->getTopOrders(20);
                break;
            case 'most-viewed':
                $products = $this->productRepo->getMostViewed(20);
                break;
            case 'trending':
                $products = $this->productRepo->getTrending(20);
                break;
            default:
                abort(404);
        }

		return $products;

        return view('section', compact('products', 'section'));
    }
}