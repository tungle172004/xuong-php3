<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if(Auth::check()){
            $user = Auth::user();
            if(in_array($user->role, $role)){
                return $next($request);
            }
        }
        return redirect('/')->with('error','Bạn không có quyền truy cập vào trang này!');
       
    }
}
