<?php

namespace App\Providers;

use App\Services\Impl\TelegramBotServiceImpl;
use App\Services\TelegramBotService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TelegramBotServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        TelegramBotService::class => TelegramBotServiceImpl::class
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
        return [TelegramBotService::class];
    }
}
