<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Student;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $login = $request->validate([
            'email'=> 'required|string',
            'password'=> 'required|string'
        ]);

        if (! Auth::attempt($login)) {
            return response(['message' => 'invalid login credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $accessToken]);

    }


    public function getUser()
    {

        
        $user = auth('api')->user();

        if ($user->user_type !== 'driver') {
            return response(['message'=> 'user is not driver']);
        }
        return response(['user' => $user]);
    }


    public function getStudents() {
        $user = auth('api')->user();

        $vehicle = Vehicle::where('driver_id', '=', $user->id)->first() ?? 'driver is not assigned vehicle';


        if ($vehicle !== 'driver is not assigned vehicle') {
            $students = Student::where('vehicle_id', '=', $vehicle->id)->get();

            
        }

        return response(['students' => $students]);
    }


    public function myStudentCount()
    {
        $user = auth('api')->user();

        $vehicle = Vehicle::where('driver_id', '=', $user->id)->first() ?? 'driver is not assigned vehicle';

        $numOfStudents = 0;

        if ($vehicle !== 'driver is not assigned vehicle') {
            $numOfStudents = count(Student::where('vehicle_id', '=', $vehicle->id)->get());

            
        }

        return response(['num of students' => $numOfStudents]);
    }

    public function getVehicle()
    {
        $user = auth('api')->user();

        $vehicle = Vehicle::where('driver_id', '=', $user->id)->first() ?? 'driver is not assigned vehicle';

        return response(['vehicle' => $vehicle]);
    }
}
