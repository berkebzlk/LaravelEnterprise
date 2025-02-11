<?php

namespace App\Modules\Product\Providers;

use App\Providers\BaseRouteServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    private $moduleName = 'Product';

    protected function configureRateLimiting(): void
    {
        parent::configureRateLimiting();

        // Define custom rate limiting rules for this module
        RateLimiter::for('api.' . lcfirst($this->moduleName), function (Request $request) {
            return Limit::perMinute(100)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Define the routes for the module.
     *
     * @return void
     */

    public function map()
    {
        // $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the module.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path('app/Modules/' . $this->moduleName . '/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the module.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::middleware('throttle:api.product')
            ->middleware('api')
            ->prefix('api')
            ->group(base_path('app/Modules/' . $this->moduleName . '/Routes/api.php'));
    }
}
