<?php

namespace App\Http\Middleware;

use App\Enum\UserRoles;
use App\Services\ProductServices;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPDPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userid = ProductServices::getProductById($request->pid)->user_id;
        if (Auth::user()->role_id == UserRoles::ADMIN)
            return $next($request);
        else if (Auth::user()->id == $userid) {
            return $next($request);
        } else
            return "<div class=\"alert alert-danger\" role=\"alert\">
                      You don't have permission to do this!
                    </div>";
    }
}
