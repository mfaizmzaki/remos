<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(){

        $student_id = Auth::id();

        $registered_events = Registration::where('student_id', $student_id)->get();
        // dd($registered_events);
        return view('dashboards.student_dashboard', ['registered_events' => $registered_events]); 
    }
}
