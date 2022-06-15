<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Event;
use App\Models\Location;
use App\Models\User;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('pgoffice');
    }

    public function index(){

        $departments = Department::get();
        $locations = Location::get();
        $lecturers = User::where('role_id', 3)->get();

        return view('events.create', ['departments' => $departments, 'locations' => $locations, 'lecturers' => $lecturers]);
    }
    public function create(Request $request){

        $event = Event::create([
            'department_id' => $request->department,
            'event_mode' => $request->eventMode,
            'location_id' => $request->location,
            'date' => $request->date,
            'time' => $request->time,
            'chair_id' => $request->chair
        ]);
 
        return redirect()->route('pgoffice')->with('store_message', 'Event successfully created!');
    }
}