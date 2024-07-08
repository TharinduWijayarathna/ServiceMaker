<?php

namespace Tharindu\ServiceMaker\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name?}';
    protected $description = 'Generate a service file';

    public function handle()
    {
        $name = $this->argument('name');
        $folder = '';
        $serviceName = '';

        if ($name) {
            // Split the name into folder and service name
            $segments = explode('/', $name);
            $serviceName = array_pop($segments);
            $folder = implode('/', $segments);

            if (!empty($folder)) {
                File::ensureDirectoryExists(app_path('Services/' . $folder));
            }
        } else {
            $folder = $this->ask('Enter the folder name for the service (leave empty for none)');
            if (!empty($folder)) {
                File::ensureDirectoryExists(app_path('Services/' . $folder));
            }

            $serviceName = $this->ask('Enter the service name');
        }

        $modelName = $this->ask('Enter the model name related to this service (e.g., Product)');

        $stub = file_get_contents(__DIR__ . '/stubs/service.stub');
        $stub = str_replace('{{namespace}}', 'App\Services\\' . $folder, $stub);
        $stub = str_replace('{{modelName}}', $modelName, $stub);
        $stub = str_replace('{{serviceName}}', $serviceName, $stub);

        file_put_contents(app_path('Services/' . $folder . '/' . $serviceName . '.php'), $stub);

        $this->info('Service created successfully!');
    }
}
