<?php

namespace App\Providers;

use App\Services\Impl\NotifikasiServiceImpl;
use App\Services\NotifikasiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class NotifikasiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        NotifikasiService::class => NotifikasiServiceImpl::class
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
        return [NotifikasiService::class];
    }
}
