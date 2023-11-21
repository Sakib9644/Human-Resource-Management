<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionsMiddleware
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $userPermissions = auth()->user()->permissions;

        foreach ($permissions as $permission) {
            if (!$userPermissions->contains($permission)) {
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}