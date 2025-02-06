<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Önce Core modülünün config'lerini yükle
        $coreConfigPath = base_path('app/Modules/Core/Configs');
        $this->loadConfigsFromPath($coreConfigPath);

        // Sonra diğer modüllerin config'lerini yükle
        $modulesPath = base_path('app/Modules');
        foreach (scandir($modulesPath) as $module) {
            // Core modülünü ve özel dizinleri atla
            if ($module === '.' || $module === '..' || $module === 'Core') {
                continue;
            }

            $moduleConfigPath = "$modulesPath/$module/Config";
            if (is_dir($moduleConfigPath)) {
                $this->loadConfigsFromPath($moduleConfigPath);
            }
        }
    }

    private function loadConfigsFromPath($path)
    {
        if (!is_dir($path)) {
            return;
        }

        foreach (scandir($path) as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            
            $configName = pathinfo($file, PATHINFO_FILENAME);
            $this->mergeConfigFrom("$path/$file", $configName);
        }
    }
}
