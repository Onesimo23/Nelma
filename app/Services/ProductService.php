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
        // Fake Store API não suporta busca por texto diretamente
        // Usamos um filtro básico nos resultados como alternativa
        $products = Http::get("{$this->apiUrl}/products")->json();

        return array_filter($products, function ($product) use ($query) {
            return stripos($product['title'], $query) !== false;
        });
    }

    public function getProductDetails($product_id)
    {
        $response = Http::get("{$this->apiUrl}/products/{$product_id}");
        return $response->json();
    }
}
