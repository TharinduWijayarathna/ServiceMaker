<?php

namespace Tharindu\ServiceMaker;

use Illuminate\Support\ServiceProvider;
use Tharindu\ServiceMaker\Commands\MakeServiceCommand;

class ServiceMakerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeServiceCommand::class,
            ]);
        }
    }

    public function register()
    {
        // Register any package services here
    }
}
