<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserSwitchController extends Controller
{
    public function index(){
        $users = User::all();

        return view('user_switch', ['users' => $users]); 
    }
    
    public function switchUser(Request $request){
        $request->session()->put('existing_user_id', Auth::user()->id);
        $request->session()->put('user_is_switched', true);
        $newuserId = $request->input('new_user_id');
        Auth::loginUsingId($newuserId);
        return redirect()->to('/');
    }

    public function restoreUser(Request $request) {
        $oldUserId = $request->session()->get('existing_user_id');
        Auth::loginUsingId($oldUserId);
        $request->session()->forget('existing_user_id');
        $request->session()->forget('user_is_switched');
        return redirect()->back();
    }
}
