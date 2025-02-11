<?php

namespace App\Modules\Product\Services;

use App\Modules\Product\Interfaces\Repositories\ProductRepositoryInterface;
use App\Modules\Product\Interfaces\Services\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function createProduct($data)
    {
        return $this->productRepository->create($data);
    }

    public function getAllProducts()
    {
        return $this->productRepository->findAll();
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function updateProduct($id, $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }


}