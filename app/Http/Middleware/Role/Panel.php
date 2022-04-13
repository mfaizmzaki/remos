<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Panel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()){
            return redirect()->route('login'); //localhost:8000/login
        }

        $role_name = Auth::user()->role->role_name;

        switch($role_name){
            case('Admin'):
                return redirect()->route('admin');
                break;
            case('Student'):
                return redirect()->route('student');
                break;
            case('Lecturer'):
                return redirect()->route('lecturer');
                break;
            case('Panel'):
                return $next($request);
                break;
            case('PGOffice'):
                return redirect()->route('pgoffice');
                break;
        }
    }
}
