<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cart = new Cart();
        $cart->id = Uuid::uuid4()->toString();
        $cart->quantity = 1;
        $cart->user_id = 'cdb8e563-41c1-4223-a285-5e62b14ad972';
        $cart->save();
    }
}
