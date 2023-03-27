<?php

namespace Branko\Transcriby\Providers;

use Branko\Transcriby\TranscribyService;
use Illuminate\Support\ServiceProvider;

class TranscribyServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->app->bind('transcriby', function () {
            return new TranscribyService();
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                dirname(__DIR__, 2) . '/config' => config_path(''),
            ], 'config');
        }
    }
}
