<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Event;

class PGOfficeController extends Controller
{
    public function index(){

        $events = Event::get();
        $departments = Department::where('id', '!=', 5)->get();

        return view('dashboards.pgoffice_dashboard', ['events' => $events, 'departments'=>$departments]); 
    }
}
