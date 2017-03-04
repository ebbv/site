<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Member;

class VerifyRole
{
    public function handle($request, Closure $next, $role)
    {
        if (! Member::has($role)->find($request->user()->id)) {
            return redirect('error');
        }

        return $next($request);
    }
}
