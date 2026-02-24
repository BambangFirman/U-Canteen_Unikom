<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    public function dashboard(): Response
    {
        $totalShops = Shop::count();
        $totalMenus = Menu::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        return response()
            ->view('admin.dashboard', [
                'title' => 'Admin Dashboard | U-Canteen',
                'totalShops' => $totalShops,
                'totalMenus' => $totalMenus,
                'totalCategories' => $totalCategories,
                'totalUsers' => $totalUsers
            ]);
    }

    public function shopIndex(): Response
    {
        $shops = Shop::all();

        return response()
            ->view('admin.shops.index', [
                'title' => 'Kelola Toko | U-Canteen',
                'shops' => $shops
            ]);
    }

    public function menuIndex(string $shopId): Response
    {
        $shop = Shop::query()->findOrFail($shopId);
        $menus = Menu::with(['category'])->where('shop_id', $shopId)->get();

        return response()
            ->view('admin.menus.index', [
                'title' => "Kelola Menu — {$shop->name} | U-Canteen",
                'menus' => $menus,
                'shop' => $shop
            ]);
    }
}
