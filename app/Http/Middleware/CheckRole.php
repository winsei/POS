<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Pastikan pengguna sudah login dan memiliki role yang sesuai
        if (auth()->check() && auth()->user()->role == $role) {
            return $next($request);
        }

        // Jika tidak, alihkan ke halaman login
        return redirect('/login');
    }
}
