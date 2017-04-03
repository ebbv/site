<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Member;

class VerifyRole
{
    public function handle($request, Closure $next, $role, $id = null)
    {
        if ($request->user()->id == $id or Member::has($role)->find($request->user()->id)) {
            return $next($request);
        }

        return redirect('error');
    }
}
