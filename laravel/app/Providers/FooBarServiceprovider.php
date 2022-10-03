<?php

namespace App\Providers;

use App\data\Bar;
use app\data\Foo;
use app\services\HelloService;
use Illuminate\Support\ServiceProvider;

class FooBarServiceprovider extends ServiceProvider
{
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Foo::class, function(){
            return new Foo;
        });
        $this->app->singleton(Bar::class, function($app){
            return new Bar($app->make(Foo::class));
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
