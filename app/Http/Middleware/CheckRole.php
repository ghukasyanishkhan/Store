<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (!Auth::check() || !$request->user()->hasRole($role)) {

            return redirect('login')->with('error', 'You do not have access to this page.');
        }

        return $next($request);
    }
}
