<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Member;

class VerifyRole
{
    public function handle($request, Closure $next, $role)
    {
        if (! Member::has($role)->find(Auth::id())) {
            return view('errors.no_admin');
        }

        return $next($request);
    }
}
