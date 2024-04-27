<?php

namespace App\Providers;

use App\Services\Impl\RiwayatTransaksiServiceImpl;
use App\Services\RiwayatTransaksiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RiwayatTransaksiProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        RiwayatTransaksiService::class => RiwayatTransaksiServiceImpl::class
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
        return [RiwayatTransaksiService::class];
    }
}
