<?php

namespace App\Http\Middleware;


use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAgeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $user = Auth::user();
             
            $birthdate = $user->birth_date;

            $age = Carbon::parse($birthdate)->age;

            if($age < 18){
                return redirect('/')->with('error', 'Bạn chưa đủ tuổi để truy cập');
            }
        }
        return $next($request);
    }
}
