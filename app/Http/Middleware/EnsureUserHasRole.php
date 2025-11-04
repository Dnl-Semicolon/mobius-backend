<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            // Not authenticated: let the auth middleware handle redirects,
            // but we also fail-safe here.
            abort(401, 'Unauthenticated.');
        }

        // If no roles were passed, deny by default
        if (empty($roles)) {
            abort(403, 'Role not specified.');
        }

        // Accept case-insensitive match to be nice
        $userRole = strtolower((string) $user->role);
        $allowed  = array_map(fn ($r) => strtolower(trim($r)), $roles);

        if (!in_array($userRole, $allowed, true)) {
            abort(403, 'Forbidden: insufficient role.');
        }

        return $next($request);
    }
}
