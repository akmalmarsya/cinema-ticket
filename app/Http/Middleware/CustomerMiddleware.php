<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (!Auth::check()) {
            return redirect()
                ->route('customer.login')
                ->with('info', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'customer') {

            if (Auth::user()->role === 'admin') {
                return redirect()
                    ->route('admin.dashboard')
                    ->with('error', 'Halaman ini khusus customer.');
            }

            abort(403);
        }

        return $next($request);
    }
}