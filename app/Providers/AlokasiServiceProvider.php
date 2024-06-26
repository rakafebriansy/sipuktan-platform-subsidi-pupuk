<?php

namespace App\Providers;

use App\Services\AlokasiService;
use App\Services\Impl\AlokasiServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AlokasiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        AlokasiService::class => AlokasiServiceImpl::class
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
        return [AlokasiService::class];
    }
}
