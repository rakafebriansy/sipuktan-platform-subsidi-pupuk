<?php

namespace App\Providers;

use App\Services\HomepageService;
use App\Services\Impl\HomepageServiceImpl;
use Illuminate\Support\ServiceProvider;

class HomepageServiceProvider extends ServiceProvider
{
    public array $singletons =[
        HomepageService::class => HomepageServiceImpl::class
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
        return [HomepageService::class];
    }
}
