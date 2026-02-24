<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from menus_carts');
        DB::delete('delete from carts');
    }

    public function testAddToCartSuccess()
    {
        $this->withSession([
            'name' => 'Asep Yaman Suryaman',
            'username' => 10122004
        ])->post('/zupa/e48330da-5922-4793-b5ba-9c7166967d7e')
            ->assertRedirect()
            ->assertSessionHas('success', 'Berhasil menambahkan ke keranjang');
    }

    public function testAddToCartFail()
    {
        $this->withSession([
            'name' => 'Asep Yaman Suryaman',
            'username' => 10122004
        ])->post('/zupa/e48330da-922-4793-b5ba-9c7166967d7e')
            ->assertRedirect()
            ->assertSessionHas('error', 'Gagal menambahkan ke keranjang');
    }

    public function testDelete()
    {
        $this->withSession([
            'name' => 'Asep Yaman Suryaman',
            'username' => 10122004
        ])->post('/cart/delete/nasi-sostel/ae27dd76-6e85-4378-b4d3-0e29cf024153')
            ->assertSessionHas('success', 'Item berhasil di hapus')
            ->assertRedirect();
    }


}
