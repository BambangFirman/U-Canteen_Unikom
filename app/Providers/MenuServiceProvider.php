<?php

namespace App\Providers;

use App\Service\Impl\MenuServiceImpl;
use App\Service\MenuService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        MenuService::class => MenuServiceImpl::class
    ];

    public function provides(): array
    {
        return [MenuService::class];
    }

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
