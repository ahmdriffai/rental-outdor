<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\Elequent\CartServiceImpl;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{

    public array $singletons = [
        CartService::class => CartServiceImpl::class
    ];

    public function provides(): array
    {
        return [CartService::class];
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
