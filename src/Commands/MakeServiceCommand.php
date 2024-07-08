<?php

namespace Tharindu\ServiceMaker\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service';

    protected $description = 'Generate a service file';

    public function handle()
    {
        $folder = $this->ask('Do you want to create a folder for the service? (yes/no)');
        $folderName = '';

        if ($folder === 'yes') {
            $folderName = $this->ask('Enter the folder name for the service');
            File::ensureDirectoryExists(app_path('Services/' . $folderName));
        }

        $modelName = $this->ask('Enter the model name related to this service (e.g., Product)');

        $serviceName = $this->ask('Enter the service name (e.g., ProductService)');

        $stub = file_get_contents(__DIR__ . '/stubs/service.stub');
        $stub = str_replace('{{namespace}}', 'App\Services\\' . $folderName, $stub);
        $stub = str_replace('{{modelName}}', $modelName, $stub);
        $stub = str_replace('{{serviceName}}', $serviceName, $stub);

        file_put_contents(app_path('Services/' . $folderName . '/' . $serviceName . '.php'), $stub);

        $this->info('Service created successfully!');
    }
}
