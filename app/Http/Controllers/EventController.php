<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Event;
use App\Models\Location;
use App\Models\Student;
use App\Models\User;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function __construct()
    {
        $this->middleware('pgoffice');
    }

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        $locations = Location::get();
        $lecturers = User::where('role_id', 3)->get();

        return view('events.create', ['departments' => $departments, 'locations' => $locations, 'lecturers' => $lecturers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create([
            'department_id' => $request->department,
            'location_id' => $request->location,
            'date' => $request->date,
            'time' => $request->time,
            'chair_id' => $request->chair
        ]);
 
        return redirect()->route('pgoffice')->with('store_message', 'Event successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $students = Student::whereRelation('user', 'department_id', $event->department_id)->get();
        $lecturers = User::where('role_id', 3)->get();

        return view('events.show', ['event'=>$event, 'students'=>$students, 'lecturers'=>$lecturers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
