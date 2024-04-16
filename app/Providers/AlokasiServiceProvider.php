<?php

namespace App\Providers;

use App\Services\AlokasiService;
use App\Services\Impl\AlokasiServiceImpl;
use Illuminate\Support\ServiceProvider;

class AlokasiServiceProvider extends ServiceProvider
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
