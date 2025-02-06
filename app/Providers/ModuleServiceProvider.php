<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $modules = File::directories(app_path('Modules'));
        
        foreach ($modules as $module) {
            // Modül adını al
            $moduleName = basename($module);
            
            // Provider'ı yükle
            $providerClass = "App\\Modules\\{$moduleName}\\Providers\\{$moduleName}ServiceProvider";
            if (class_exists($providerClass)) {
                $this->app->register($providerClass);
            }
            
            // Migration'ları yükle
            $migrationPath = $module . '/Database/Migrations';
            if (File::isDirectory($migrationPath)) {
                $this->loadMigrationsFrom($migrationPath);
            }
            
            // Route'ları yükle
            $routePath = $module . '/Routes';
            if (File::isDirectory($routePath)) {
                $routes = File::glob($routePath . '/*.php');
                foreach ($routes as $route) {
                    $this->loadRoutesFrom($route);
                }
            }
            
            // View'ları yükle
            $viewPath = $module . '/Resources/Views';
            if (File::isDirectory($viewPath)) {
                $this->loadViewsFrom($viewPath, strtolower($moduleName));
            }
        }
    }
}
