<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class AdminAuth
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
        $response = $next($request);

        if (!Auth::check() && $request->is('admin/*') && $request->path() !== 'admin/login') {
//            $request->is('admin/*')
            return redirect()->route('admin.auth.login');
//            return abort(403);
        }

        return $response;
    }
}
