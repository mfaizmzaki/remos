<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Department;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('pgoffice');
    }

    public function index(){

        $roles = Role::get();
        $departments = Department::get();

        return view('users.create', ['roles' => $roles, 'departments' => $departments]);
    }

    public function create(Request $request){
        dd($request);
    }
}
