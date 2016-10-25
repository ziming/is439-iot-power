<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
//            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
//            $this->app->register(\Recca0120\LaravelTracy\ServiceProvider::class);
            $this->app->register(\Mpociot\LaravelTestFactoryHelper\TestFactoryHelperServiceProvider::class);
//            $this->app->register(\Mpociot\ApiDoc\ApiDocGeneratorServiceProvider::class);
        }

        $this->app->singleton(\Faker\Generator::class, function () {
            return \Faker\Factory::create('en_SG');
        });
    }
}
