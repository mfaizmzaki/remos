<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class PGOfficeController extends Controller
{
    public function index(){

        $events = Event::get();

        return view('dashboards.pgoffice_dashboard', ['events' => $events]); 
    }
}
