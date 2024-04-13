<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AkunServiceProvider extends ServiceProvider
{
    public array $singletons =[
        UserService::class => UserServiceImpl::class
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
}
