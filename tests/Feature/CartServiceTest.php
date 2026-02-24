<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Service\CartService;
use Database\Seeders\CartSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CartServiceTest extends TestCase
{
    private CartService $cartService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cartService = $this->app->make(CartService::class);

//        DB::delete('delete from menus_carts');
//        DB::delete('delete from carts');
    }

    public function testSaveSuccess()
    {
        $data = [
            'id' => Uuid::uuid4()->toString(),
            'quantity' => 1,
            'menu_id' => '49731131-47f1-4d79-80c7-068605b69224',
            'user_id' => 'cdb8e563-41c1-4223-a285-5e62b14ad972'
        ];

        self::assertTrue($this->cartService->saveOrUpdate($data));
//        self::assertTrue($this->cartService->saveToMenusCartsTable($data));
    }

    public function testUpdateSuccess()
    {
        $data = [
            'id' => Uuid::uuid4()->toString(),
            'quantity' => 2,
            'menu_id' => '32a2ff85-7c7f-45b6-a583-860c74369116',
            'user_id' => 'cdb8e563-41c1-4223-a285-5e62b14ad972'
        ];

        self::assertTrue($this->cartService->saveOrUpdate($data));
    }

    public function testDelete()
    {
        $this->cartService->delete('1e92e0c0-6d78-40ab-9716-508fe99180b1');

        $find = Cart::query()->find('1e92e0c0-6d78-40ab-9716-508fe99180b1');
        self::assertNull($find);
    }


}
