<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Cek apakah user memiliki role yang diizinkan
        if (auth()->user()->role !== $role) {
            abort(403, 'Unauthorized access for this role.');
        }

        return $next($request);
    }
}