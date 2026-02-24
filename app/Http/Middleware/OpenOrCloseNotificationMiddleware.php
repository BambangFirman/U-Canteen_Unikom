<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpenOrCloseNotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentTime = Carbon::now()->hour;
        if ($currentTime < 3) {
            view()->share('close', 'Selamat Malam');
        } elseif ($currentTime < 7) {
            view()->share('close', 'Selamat Pagi');
        } elseif ($currentTime < 10) {
            view()->share('open', 'Selamat Pagi');
        }elseif ($currentTime < 13) {
            view()->share('open', 'Selamat Siang');
        } elseif ($currentTime < 16){
            view()->share('open', 'Selamat Sore');
        }elseif ($currentTime < 18){
            view()->share('close', 'Selamat Sore');
        }else{
            view()->share('close', 'Selamat Malam');
        }

        return $next($request);
    }
}
