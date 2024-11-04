<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class HomePageService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getHomePageData()
    {
        return [
            'latest' => $this->productRepo->getLatestProducts(),
            'topPicks' => $this->productRepo->getTopOrders(),
            'mostViewed' => $this->productRepo->getMostViewed(),
            'hotDeals' => $this->productRepo->getOfferProducts(),
            'trending' => $this->productRepo->getTrending(),
        ];
    }
}
