<?php
/**
 * Created by PhpStorm.
 * User: Ravshan
 * Date: 26.11.2019
 * Time: 0:16
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;


class CanAdmin
{
    /**
     * Guard used for admin user
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * CanAdmin constructor.
     */
    public function __construct()
    {
        $this->guard = config('admin-auth.defaults.guard');
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard($this->guard)->check()) {
            return $next($request);
        }

        if (!Auth::guard($this->guard)->check()) {
            return redirect()->guest('/admin/login');
        } else {
            throw new UnauthorizedException('Unathorized');
        }
    }
}
