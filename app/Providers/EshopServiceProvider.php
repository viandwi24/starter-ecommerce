<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EshopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require_once __DIR__ . '/../Helpers/globalFunctions.php';
    }
}
