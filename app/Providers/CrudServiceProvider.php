<?php

namespace App\Providers;

use App\Services\CrudService;
use App\Services\Impl\CrudServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CrudServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        CrudService::class => CrudServiceImpl::class
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
        return [CrudService::class];
    }
}
