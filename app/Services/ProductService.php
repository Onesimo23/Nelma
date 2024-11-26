<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProductService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = 'https://fakestoreapi.com';
    }

    public function getFeaturedProducts()
    {
        $response = Http::get("{$this->apiUrl}/products?limit=6");
        return $response->json();
    }

    public function searchProduct($query)
    {
        $products = Http::get("{$this->apiUrl}/products")->json();

        // Filtrar produtos localmente com base no título
        return array_filter($products, function ($product) use ($query) {
            return stripos($product['title'], $query) !== false || 
                   stripos($product['description'], $query) !== false;
        });
    }

    public function getProductDetails($product_id)
    {
        $response = Http::get("{$this->apiUrl}/products/{$product_id}");
        return $response->json();
    }
    public function convertToMetical($price)
{
    $exchangeRate = 63.00; // Taxa de câmbio fictícia (1 USD = 63 MZN)
    return $price * $exchangeRate;
}

}
