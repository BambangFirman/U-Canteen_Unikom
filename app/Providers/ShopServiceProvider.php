<?php

namespace App\Providers;

use App\Service\Impl\ShopServiceImpl;
use App\Service\ShopService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        ShopService::class => ShopServiceImpl::class
    ];

    public function provides(): array
    {
        return [ShopService::class];
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
