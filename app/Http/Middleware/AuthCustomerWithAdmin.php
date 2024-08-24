<?php

namespace App\Http\Middleware;

use App\Constant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthCustomerWithAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        if (!($user->can('admin') || $user->can('customer'))) {
            abort(404);
        }

        return $next($request);
    }
}
