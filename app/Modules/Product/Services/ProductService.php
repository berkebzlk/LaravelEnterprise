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

}