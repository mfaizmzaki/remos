<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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
                return redirect()->route('students.index');
                break;
            case('Lecturer'):
                return redirect()->route('lecturer');
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
