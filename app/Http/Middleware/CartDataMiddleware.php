<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $findUser = User::query()->where('username', '=', Session::get('username'))->first();
        if (!empty($findUser)) {
            $getCarts = Cart::query()->where('user_id', '=', $findUser->id)->get();

            $qtyTotal = $getCarts->sum('quantity');

            view()->share('qtyTotal', $qtyTotal);
            view()->share('userName', $findUser->first_name ?? $findUser->username);

        } else {
            view()->share('qtyTotal', 0);
            view()->share('userName', '');
        }
        return $next($request);
    }
}
