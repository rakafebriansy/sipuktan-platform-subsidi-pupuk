<?php

namespace App\Providers;

use App\Services\FaqService;
use App\Services\Impl\FaqServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FaqServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        FaqService::class => FaqServiceImpl::class
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
        return [FaqService::class];
    }
}
