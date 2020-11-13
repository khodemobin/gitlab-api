<?php

namespace Khodemobin\Gitlab;

use Illuminate\Support\ServiceProvider;

class GitlabServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/gitlab.php' => $this->app->configPath().'/gitlab.php',
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/gitlab.php', 'gitlab.php');
    }
}
