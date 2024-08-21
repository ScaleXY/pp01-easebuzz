<?php

namespace ScaleXY\Easebuzz;

use Illuminate\Support\ServiceProvider;

class EasebuzzServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/lib/routes/webhook.php');
    }
}
