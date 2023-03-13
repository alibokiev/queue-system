<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class PermissionMiddleware
{
    // TODO::fix redirects
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::guest()) {
            return redirect('/admin/login');
        }

        if (! $request->user()->can($permission)) {
            abort(403);
        }

        return $next($request);
    }
}
