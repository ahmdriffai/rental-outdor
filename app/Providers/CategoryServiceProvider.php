<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\Elequent\CategoryServiceImpl;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{

    public array $singletons = [
        CategoryService::class => CategoryServiceImpl::class
    ];

    public function provides(): array
    {
        return [CategoryService::class];
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
