<?php

namespace App\console\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create a new module';

    public function handle()
    {
        $name = $this->argument('name');
        $modulePath = app_path('Modules/' . $name);

        // Klasör yapısını oluştur
        $directories = [
            'Config',
            'Controllers',
            'Database/Migrations',
            'Dtos',
            'Interfaces/Repositories',
            'Interfaces/Services',
            'Models',
            'Providers',
            'Repositories',
            'Resources/Views',
            'Resources/Js',
            'Resources/Css',
            'Routes',
            'Services',
        ];

        foreach ($directories as $directory) {
            File::makeDirectory($modulePath . '/' . $directory, 0755, true);
        }

        // ServiceProvider oluştur
        $this->createServiceProvider($name);

        $this->info("Module {$name} created successfully!");
    }

    protected function createServiceProvider($name)
    {
        $stub = File::get(base_path('stubs/module-provider.stub')); // Stub dosyasını oluşturmanız gerekir
        $content = str_replace('{{MODULE}}', $name, $stub);
        
        File::put(
            app_path("Modules/{$name}/Providers/{$name}ServiceProvider.php"),
            $content
        );
    }
} 