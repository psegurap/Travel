<?php

namespace App\Http\Middleware;

use Closure;

class HouseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($_SERVER['REMOTE_ADDR'] !== '152.0.202.27'){
            return redirect('/cojefavsomostodos');
        }
        return $next($request);
    }
}
