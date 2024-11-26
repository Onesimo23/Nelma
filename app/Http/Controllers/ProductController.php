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
        $featuredProducts = $this->productService->getFeaturedProducts();

        if ($request->has('query') && $request->query('query') !== '') {
            $request->validate([
                'query' => 'required|string|min:3',
            ]);

            $products = $this->productService->searchProduct($request->query('query'));
        }

        return view('products.index', compact('products', 'featuredProducts'));
    }

    public function show($id)
    {
        $productDetails = $this->productService->getProductDetails($id);

        return view('products.show', compact('productDetails'));
    }
}
