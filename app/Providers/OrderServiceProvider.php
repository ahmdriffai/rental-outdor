<?php

namespace App\Providers;

use App\Services\Elequent\OrderServiceImpl;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{

    public array $singletons = [
        OrderService::class => OrderServiceImpl::class
    ];

    public function provides(): array
    {
        return [OrderService::class];
    }

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
        //
    }
}
