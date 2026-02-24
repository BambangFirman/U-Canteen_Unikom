<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from checkouts');
    }

    public function testProcessSuccess()
    {
        $this->withSession([
            'name' => 'Asep Yaman Suryaman',
            'username' => 10122004
        ])->post('/checkout', [
            'billing_method' => 'COD',
            'pickup_time' => '15:00'
        ])->assertSessionHas('success', 'selamat');
    }

    public function testFailed()
    {
        $this->withSession([
            'name' => 'Asep Yaman Suryaman',
            'username' => 10122004
        ])->post('/checkout', [
            'billing_method' => '',
            'pickup_time' => ''
        ])->assertSeeText('Perlu memilih metode pembayaran')
            ->assertSeeText('Perlu mengisi jam pengambilan');
    }


}
