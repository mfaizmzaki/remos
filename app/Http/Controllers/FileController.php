<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\UnableToRetrieveMetadata;

class FileController extends Controller
{
    public function download(Request $request){
        try{
            return Storage::download($request->report);
        } catch (UnableToRetrieveMetadata){
            return back()->with('file_error', 'File not found');
        }
        
    }

    public function delete(Request $request){
        return Storage::delete($request->report);
    }
}
