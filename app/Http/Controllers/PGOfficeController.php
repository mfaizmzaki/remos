<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PGOfficeController extends Controller
{
    public function index(){
        return view('dashboards.pgoffice_dashboard'); 
    }
}
