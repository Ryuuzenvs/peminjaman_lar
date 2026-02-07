<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\authController;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next

get roole param,
if auth cek , auth usr role != role
abrt 403
     */
    public function handle(Request $request, Closure $next, $role): Response
{
    // Cek user login di guard yang diminta
    if (!auth()->guard($role)->check()) {
        $user = "Guest";
        if(auth()->guard('admin')->check()) $user = "Admin";
        if(auth()->guard('officer')->check()) $user = "Officer";
        if(auth()->guard('borrower')->check()) $user = "Borrower";

        abort(403, "Akses Ditolak: Anda login sebagai $siapaYangLogin, tapi butuh akses $role");
    }

    return $next($request);
    }   
}
