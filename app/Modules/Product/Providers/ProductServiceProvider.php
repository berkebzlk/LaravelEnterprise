<?php

namespace App\Modules\Product\Providers;

use App\Modules\Product\Interfaces\Repositories\ProductRepositoryInterface;
use App\Modules\Product\Interfaces\Services\ProductServiceInterface;
use App\Modules\Product\Repositories\ProductRepositoryEloquent;
use App\Modules\Product\Services\ProductService;
use Illuminate\Support\ServiceProvider;



class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepositoryEloquent::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
    }
}
