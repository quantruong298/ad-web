<?php

namespace App\Http\Middleware;

use App\Enum\UserRoles;
use Closure;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_id==UserRoles::ADMIN)
            return $next($request);
        else
            return back();
    }
}
