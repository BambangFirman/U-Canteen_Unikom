<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Service\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

class CartController extends Controller
{
    private CartService $cartService;

    /**
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addCart(string $menuName, string $menuId): RedirectResponse
    {
        $findUserId = User::query()->where('username', '=', Session::get('username'))->first();
        $dataMenu = [
            'id' => Uuid::uuid4()->toString(),
            'menu_id' => $menuId,
            'user_id' => $findUserId->id,
            'quantity' => 1
        ];

        $result = $this->cartService->saveOrUpdate($dataMenu);
        if ($result) {
            return redirect()->back()
                ->with('success', 'Berhasil menambahkan ke keranjang');
        }

        return redirect()->back()
            ->with('error', 'Gagal menambahkan ke keranjang');

    }

    public function deletePerCartItem(string $menuName, string $cartId): RedirectResponse
    {
        $this->cartService->delete($cartId);

        return redirect()->back()
            ->with('success', 'Item berhasil di hapus');

    }
}
