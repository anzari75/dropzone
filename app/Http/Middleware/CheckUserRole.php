<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        //get current logged in user info
        $user = auth()->user();

        if (!$user->hasRole($role)){

            dd('Anda Bukan Admin Tidak Boleh akses Ruangan Ini ');

        }
        return $next($request);
    }
}
