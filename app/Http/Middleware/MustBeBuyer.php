<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeBuyer
{
    /**
     * Handle an incoming request.
     * Only allows users with 'user' role to access buyer pages.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('username')) {
            return redirect('/login');
        }

        $user = \App\Models\User::query()->where('username', '=', session()->get('username'))->first();

        if (!$user) {
            return redirect('/login');
        }

        // Admin harus ke halaman admin, bukan halaman pembeli
        if ($user->role === 'admin') {
            return redirect('/admin')->with('error', 'Akun admin tidak bisa mengakses halaman pembeli. Silakan gunakan akun pembeli.');
        }

        return $next($request);
    }
}
