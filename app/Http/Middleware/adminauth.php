<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class adminauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        if (!Auth::guard($guard)->check()) 
        {
            return redirect('admin/login');
        }
        
        Auth::shouldUse($guard);
        return $next($request);
    }
}
