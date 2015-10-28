<?php

namespace App\Http\Middleware;

use Closure;

class VerifyRole
{
  public function handle($request, Closure $next, $role)
  {
    if(! \App\Models\Member::has($role)->find(\Auth::id()))
    {
        return \View::make('errors.no_admin');
    }

    return $next($request);
  }
}
