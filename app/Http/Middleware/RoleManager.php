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
       // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Ambil user yang sedang login (Guard Web)
        $user = Auth::user();

        // 3. Cek apakah role user sesuai dengan yang diminta route
        // Kita bandingkan langsung dengan kolom 'role' di tabel users
        if ($user->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, lempar 403 (Forbidden)
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
