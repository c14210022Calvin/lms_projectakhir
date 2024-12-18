<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // return $next($request);
        // if ($request->user()->role !== $role) {
        //     abort(403, 'Unauthorized');
        // }
        // Cek apakah user memiliki role yang sesuai
        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Unauthorized'); // Akses ditolak jika role tidak cocok
        }

        return $next($request);
    }
}
