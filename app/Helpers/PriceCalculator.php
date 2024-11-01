<?php
// app/Helpers/PriceCalculator.php

namespace App\Helpers;

class PriceCalculator
{
    public static function calculatePrices($regularPrice, $salePercentage, $quantity)
    {
        // Calculate sale price based on the sale percentage
        $salePrice = $salePercentage ? $regularPrice * (1 - $salePercentage / 100) : $regularPrice;

        return [
            'price' => $regularPrice, // Regular price
            'salePrice' => $salePrice, // Discounted price if applicable
            'quantity' => $quantity,    // Quantity of items
            'totalSale' => $salePrice * $quantity, // Total sale price
            'totalPrice' => $regularPrice * $quantity, // Total regular price
        ];
    }
}
