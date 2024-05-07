<?php

namespace App\Providers;

use App\Services\Impl\KeluhanServiceImpl;
use App\Services\KeluhanService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class KeluhanServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        KeluhanService::class => KeluhanServiceImpl::class
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
        return [KeluhanService::class];
    }
}
