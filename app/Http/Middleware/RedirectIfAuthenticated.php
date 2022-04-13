<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role_name = Auth::user()->role->role_name;

            switch($role_name){
                case('Admin'):
                    return redirect()->route('admin');
                    break;
                case('Student'):
                    return redirect()->route('student');
                    break;
                case('Lecturer'):
                    return redirect()->route('lecturert');
                    break;
                case('Panel'):
                    return redirect()->route('panel');
                    break;
                case('PGOffice'):
                    return redirect()->route('pgoffice');
                    break;
            }
            }
        }

        return $next($request);
    }
}
