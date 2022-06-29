<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('pgoffice');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        //dd($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student' => ['required'],
            'event_id' => ['required'],
            'eventMode' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'abstract' => ['nullable','string', 'maxwords:500'],
            'report' => ['nullable', 'mimes:pdf,docx', 'max:5000'],
            'supervisor' => ['required', 'array', 'max:2']
        ]);

        if($validator->fails()){
            // dd($validator->errors());
            return back()->withErrors($validator);
        }else{
            if($request->hasFile('report')){
                Registration::create([
                    'student_id' => $request->student,
                    'event_id' => $request->event_id,
                    'event_mode' => $request->eventMode,
                    'title' => $request->title,
                    'abstract' => $request->abstract,
                    'sv_1_id' => $request->supervisor[0],
                    'sv_2_id' => $request->supervisor[1] ?? null,
                    'report_upload_path' => $request->file('report')->storeAs('remos_report', $request->student.Carbon::now()->format('dmY').'.pdf')
                ]);
    
               return back()->with('registration_message', 'Student successfully added to event!');
            } else {
                Registration::create([
                    'student_id' => $request->student,
                    'event_id' => $request->event_id,
                    'event_mode' => $request->eventMode,
                    'title' => $request->title,
                    'abstract' => $request->abstract,
                    'sv_1_id' => $request->supervisor[0],
                    'sv_2_id' => $request->supervisor[1] ?? null,
                ]);

                return back()->with('registration_message', 'Student successfully added to event!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($department_id)
    {
        $students = User::where('role_id', 1)->where('department_id', $department_id)->get();
        $lecturers = User::where('role_id', 3)->get();

        return view('registrations.show', ['students'=>$students, 'lecturers'=>$lecturers]);
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
