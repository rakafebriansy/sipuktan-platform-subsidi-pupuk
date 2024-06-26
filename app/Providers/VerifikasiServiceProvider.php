<?php

namespace App\Providers;

use App\Services\Impl\VerifikasiServiceImpl;
use App\Services\VerifikasiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class VerifikasiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        VerifikasiService::class => VerifikasiServiceImpl::class
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
        return [VerifikasiService::class];
    }
}
