<?php

namespace App\console\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
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

        $this->info("Creating module...");
        $this->call('make:module-service-provider', ['name' => $name]);
        $this->call('make:module-route-service-provider', ['name' => $name]);
        $this->call('make:api-route', ['name' => $name]);
        $this->info("Module {$name} created successfully!");
    }
}
