<?php

namespace App\Modules\Product\Controllers;

use App\Modules\Product\Interfaces\Services\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function store(Request $request)
    {
        $product = $this->productService->createProduct($request->all());
        return response()->json($product);
    }

    public function index() 
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = $this->productService->updateProduct($id, $request->all());
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = $this->productService->deleteProduct($id);
        return response()->json($product);
    }
}
