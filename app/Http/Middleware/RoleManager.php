<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

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
        $user = $request->user;
    // Cek user login di guard yang diminta
    if (!Auth::guard($role)->check()) {
        abort(403, "Akses Ditolak: Anda tidak punya akses sebagai $role");
    }
    return $next($request);
    }   
}
