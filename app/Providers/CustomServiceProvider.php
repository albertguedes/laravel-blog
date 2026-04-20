<?php

namespace App\Providers;

use App\Custom\TreeCategory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use League\CommonMark\MarkdownConverter;

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

        $this->app->singleton(MarkdownConverter::class, function () {
            $environment = Environment::createCommonMarkEnvironment();

            return new MarkdownConverter($environment);
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
