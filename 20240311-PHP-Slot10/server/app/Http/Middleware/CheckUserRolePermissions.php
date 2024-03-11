<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckUserRolePermissions
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        foreach ($permissions as $permission) {
            if (!$request->user()->can($permission)) {
                return response()->json(['message' => 'You do not have permission to access this resource.'], Response::HTTP_FORBIDDEN);
            }
        }

        return $next($request);
    }
}
