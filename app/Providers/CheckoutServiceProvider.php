<?php

namespace App\Providers;

use App\Service\CheckoutService;
use App\Service\Impl\CheckoutServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CheckoutServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        CheckoutService::class => CheckoutServiceImpl::class
    ];

    public function provides(): array
    {
        return [CheckoutService::class];
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
