<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckAdminLogin
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('adminData')) 
        {
            return redirect('admin/login')->with('message', 'Please Login Again!');
        }
        return $next($request);
    }
}
