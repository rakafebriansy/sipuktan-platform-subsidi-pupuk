<?php

namespace App\Providers;

use App\Services\DashboardService;
use App\Services\Impl\DashboardServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        DashboardService::class => DashboardServiceImpl::class
    ];
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
        //
    }
    public function provides():array
    {
        return [DashboardService::class];
    }
}
