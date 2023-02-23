<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //     // $role = Auth::id();
        //     dd(auth()->user()->role_id);
        // if (Auth::id()) {
        // $role = Role::first();
        // dd($role);
        $role = DB::table('model_has_roles')->where('model_id', auth()->user()->id)->first();
        $role_id = $role->role_id;
        $role_name = Role::where('id', $role_id)->first();
        // $role = $user->role ? $user->role->name : '';
        // }
        // dd($role_name);
        if (Auth::guard('web')->check() && $role_name->name == 'admin') {
            return $next($request);
        } else {
            $message = [
                "status" => "error",
                "message" => "Permission Denied"
            ];
            return response($message, 403);
        }
    }
}
