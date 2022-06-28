<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download(Request $request){
        return Storage::download($request->report);
    }

    public function delete(Request $request){
        return Storage::delete($request->report);
    }
}
