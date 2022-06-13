<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request){
        Interest::create([
            'student_id' => $request->user()->id,
            'defence_type' => $request->defence_type,
            'title' => $request->title,
            'sv_1' => $request->sv_1,
            'sv_2' => $request->sv_2,
            'sv_3' => $request->sv_3,
            'status' => 'Pending'
        ]);
    }

    public function show($interest_id){
        $interest = Interest::find($interest_id);
        dd($interest);
        return response()->json([
            'data' => $interest
          ]);
    }

    public function update(Request $request, $id){
        Interest::where('id', $id)
        ->update([
            'defence_type' => $request->defence_type,
            'title' => $request->title,
            'sv_1' => $request->sv_1,
            'sv_2' => $request->sv_2,
            'sv_3' => $request->sv_3
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $book = Interest::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }
}
