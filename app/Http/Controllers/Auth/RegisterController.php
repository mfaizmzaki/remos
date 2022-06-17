<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pgoffice');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'matric' => ['required', 'digits_between:8,10', 'unique:students,matric_id'],
            'program' => ['required'],
            'semester' => ['required', 'numeric', 'digits_between:1,2', 'max:12'],
            'department' => ['required'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role'],
            'department_id' => $data['department'],
            
        ]);

        if($data['role'] == "1"){
            Student::create([
                'user_id' => User::where('email', $data['email'])->value('id'),
                'matric_id' => $data['matric'],
                'program' => $data['program'],
                'current_semester' => $data['semester'],
                'mode_program' => "bingo"
            ]);
        }
    }
}
