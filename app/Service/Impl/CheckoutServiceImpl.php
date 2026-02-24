<?php

namespace App\Service\Impl;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Menu;
use App\Models\User;
use App\Service\CheckoutService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;


class CheckoutServiceImpl implements CheckoutService
{
    public function checkout(string $username): Collection|bool
    {
        $findUser = User::query()->where('username', '=', $username)->first();
        $cart = DB::table('menus_carts')
            ->join('carts', 'menus_carts.cart_id', '=', 'carts.id')
            ->join('menus', 'menus_carts.menu_id', '=', 'menus.id')
            ->select(
                'menus.id as menu_id',
                'menus.menuName',
                'menus.price',
                'menus.desc',
                'menus.img',
                'carts.quantity',
                'carts.id as cart_id',
                DB::raw('SUM(menus.price) * carts.quantity as amount')
            )->groupBy('menus.id', 'menus.menuName', 'menus.price', 'menus.desc', 'menus.img', 'carts.quantity', 'carts.id'
            )->where('carts.user_id', '=', $findUser->id)->get();

        if ($cart == null) {
            return false;
        }

        return $cart;
    }

    public function process(array $data): bool
    {
        $username = Session::get('username');

        $findUser = User::query()->where('username', '=', $username)->first();
        $getMenus = $this->checkout($username);

        $result = false;
        foreach ($getMenus as $menu) {
            $checkout = new Checkout();
            $checkout->id = Uuid::uuid4()->toString();
            $checkout->invoice = $data['invoice'];
            $checkout->menu_id = $menu->menu_id;
            $checkout->user_id =  $findUser->id;
            $checkout->billing_method =  $data['billing_method'];
            $checkout->pickup_time =  $data['pickup_time'];
            $checkout->quantity = $menu->quantity;

            $result = $checkout->save();

            $cart = Cart::query()->find($menu->cart_id);

            $cart->cart_items()->detach();
            $cart->delete();
        }

        return $result;
    }

    public function getInvoice(string $invoiceId): array
    {
        $findUser = User::query()->where('username', '=', Session::get('username'))->first();
        $invoiceData = DB::table('checkouts')
            ->join('menus', 'checkouts.menu_id', '=', 'menus.id')
            ->select('menus.id',
                'menus.menuName',
                'menus.price',
                'checkouts.billing_method',
                'checkouts.invoice',
                'checkouts.pickup_time',
                'checkouts.quantity',
                'checkouts.created_at',
                DB::raw('menus.price * checkouts.quantity as total_price')
            )
            ->where('invoice', '=', $invoiceId)
            ->get();

        return [
            'user' => $findUser,
            'invoice' => $invoiceData
        ];

    }

}
