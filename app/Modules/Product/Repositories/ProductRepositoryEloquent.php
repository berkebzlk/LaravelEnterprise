<?php

namespace App\Modules\Product\Repositories;

use App\Modules\Core\Repositories\BaseRepositoryEloquent;
use App\Modules\Product\Interfaces\Repositories\ProductRepositoryInterface;
use App\Modules\Product\Models\Product;

class ProductRepositoryEloquent extends BaseRepositoryEloquent implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
