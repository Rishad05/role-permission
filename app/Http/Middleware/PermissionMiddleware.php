<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role as ModelsRole;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);
        // dd($authGuard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (!is_null($permission)) {
            $permissions = is_array($permission)
                ? $permission
                : explode('|', $permission);
        }

        if (is_null($permission)) {
            $permission = $request->route()->getName();

            $permissions = array($permission);
        }
        $role = ModelsRole::where('id', auth()->user()->role_id)->first();
        // dd($authGuard->user());
        foreach ($permissions as $permission) {
            if ($authGuard->user()->can($permission) || $role->name == 'admin') {
                return $next($request);
            }
        }
        return response()->json(['success' => '200', 'message' => ' Permission denied']);

        //throw UnauthorizedException::forPermissions($permissions);
    }
}