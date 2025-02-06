<?php

namespace App\Modules\Product\Controller;

use App\Modules\Product\Interface\ProductServiceInterface;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll();
        return response()->json($products);
    }
}
