<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('username')) {
            return redirect('/login');
        }

        $user = \App\Models\User::query()->where('username', '=', session()->get('username'))->first();

        if (!$user || $user->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses admin.');
        }

        return $next($request);
    }
}
