<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login dan apakah role-nya sesuai dengan yang diminta
        if (!auth()->check() || auth()->user()->role !== $role) {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden: Anda tidak punya hak akses untuk aksi ini'
            ], 403);
        }

        return $next($request);
    }
}
