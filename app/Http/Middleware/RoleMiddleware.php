<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }


        // Allow all roles if wildcard '*' is specified
        if (in_array('*', $roles)) {
            return $next($request);
        }

        $user_role = $user->getRoleNames()->first();


        // Check if user has at least one allowed role
        if (!in_array($user_role, $roles)) {
            abort(403, 'You do not have access to this resource.');
        }

        return $next($request);
    }
}