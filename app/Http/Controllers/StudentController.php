<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(){
        $interests = Interest::where('student_id', Auth::user()->id)->get();

        return view('dashboards.student_dashboard', ['interests' => $interests]); 
    }
}
