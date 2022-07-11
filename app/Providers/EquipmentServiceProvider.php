<?php

namespace App\Providers;

use App\Services\Elequent\EquipmentServiceImpl;
use App\Services\EquipmentService;
use Illuminate\Support\ServiceProvider;

class EquipmentServiceProvider extends ServiceProvider
{
    public array $singletons = [
        EquipmentService::class => EquipmentServiceImpl::class
    ];

    public function provides() : array
    {
        return [EquipmentService::class];
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
