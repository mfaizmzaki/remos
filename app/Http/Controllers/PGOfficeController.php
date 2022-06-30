<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class PGOfficeController extends Controller
{
    public function index(){

        $events = Event::get();
        $staffs_count = count(User::where('role_id', '!=', 1)->get());
        $students_count = count(User::where('role_id', 1)->get());
        $departments = Department::where('id', '!=', 5)->get();

        return view('dashboards.pgoffice_dashboard', ['events' => $events, 
                                                      'departments'=>$departments,
                                                      'staffs_count'=>$staffs_count,
                                                      'students_count'=>$students_count]); 
    }
}
