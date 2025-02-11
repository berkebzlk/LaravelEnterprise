<?php

namespace App\Modules\Product\Interfaces\Services;

interface ProductServiceInterface 
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(array $data);
    public function updateProduct(array $data, $id);
    public function deleteProduct($id);
}