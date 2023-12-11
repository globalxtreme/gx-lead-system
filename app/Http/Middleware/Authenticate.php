<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated!'
            ], 401);
        }

        return $next($request);
    }
}
