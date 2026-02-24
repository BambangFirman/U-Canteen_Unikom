<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function home(): Response
    {
        $allShopData = Shop::all();

        return response()
            ->view('home.home', [
                'title' => 'Beranda | U-Canteen',
                'allShopData' => $allShopData
            ]);
    }
}
