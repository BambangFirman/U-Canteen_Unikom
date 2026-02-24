<?php

namespace Tests\Feature;

use App\Service\CheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CheckoutServiceTest extends TestCase
{
    private CheckoutService $checkoutService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->checkoutService = $this->app->make(CheckoutService::class);
        DB::delete('delete from checkouts');
    }

    public function testShowCheckoutCart()
    {
        $result = $this->checkoutService->checkout(10122004);

        var_dump($result->all());

        self::assertNotNull($result);

    }

    public function testProcess()
    {
        Session::put([
            'name' => 'Asep Yaman Suryaman',
            'username' => 10122004
        ]);

        $data = [
            'invoice' => time(),
            'billing_method' => 'COD',
            'pickup_time' => '13:00'
        ];

        $result = $this->checkoutService->process($data);

        self::assertTrue($result);
    }


}
