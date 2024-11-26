<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = null;
        $featuredProducts = array_map(function ($product) {
            $product['price'] = $this->productService->convertToMetical($product['price']);
            return $product;
        }, $this->productService->getFeaturedProducts());
    
        if ($request->has('query') && $request->query('query') !== '') {
            $request->validate([
                'query' => 'required|string|min:3',
            ]);
    
            $products = array_map(function ($product) {
                $product['price'] = $this->productService->convertToMetical($product['price']);
                return $product;
            }, $this->productService->searchProduct($request->query('query')));
        }
    
        return view('products.index', compact('products', 'featuredProducts'));
    }
    
    public function show($id)
    {
        $productDetails = $this->productService->getProductDetails($id);
        $productDetails['price'] = $this->productService->convertToMetical($productDetails['price']);
    
        return view('products.show', compact('productDetails'));
    }
    
}
