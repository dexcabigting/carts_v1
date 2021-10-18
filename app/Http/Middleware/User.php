<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
<<<<<<< HEAD
        if (auth()->user()->role_id == 2) {
=======
        if (auth()->user()->role_id > 0) {
>>>>>>> 2d-custom
            return $next($request);
        }
        abort(403);
    }
}
