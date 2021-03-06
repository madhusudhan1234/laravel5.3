<?php

namespace Lara\Core;

use Illuminate\Support\ServiceProvider;

/**
 * Class CoreServiceProvider
 * @package Lara\Core
 */
class CoreServiceProvider extends ServiceProvider
{

    /**
     *Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerIncludes();
        $this->registerModelEvents();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'core');
    }

    /**
     *
     */
    public function register()
    {
        //
    }

    /**
     *
     */
    public function registerIncludes()
    {
        foreach (new \DirectoryIterator(__DIR__ . '/../routes/') as $fileInfo) {
            if (!$fileInfo->isDot()) {
                include  __DIR__ . '/../routes/' . $fileInfo->getFilename();
            }
        }
    }
    /**
     * Register the Event Subscriber(Observer) for Models
     *
     * @return void
     */
    public function registerModelEvents()
    {
    }
}