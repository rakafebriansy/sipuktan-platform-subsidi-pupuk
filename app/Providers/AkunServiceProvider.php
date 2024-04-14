<?php

namespace App\Providers;

use App\Services\AkunService;
use App\Services\Impl\AkunServiceImpl;
use Illuminate\Support\ServiceProvider;

class AkunServiceProvider extends ServiceProvider
{
    public array $singletons =[
        AkunService::class => AkunServiceImpl::class
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
        return [AkunService::class];
    }
}
