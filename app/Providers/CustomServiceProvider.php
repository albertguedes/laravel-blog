<?php

namespace App\Providers;

use App\Custom\TreeCategory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('treecategory', function () {
            return new TreeCategory;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
