<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\User;
use App\Vehicle;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GeneratedPassword;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::where('user_type', 'LIKE', 'driver')->get();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;
        

        return view('drivers.index')->with(['drivers' => $drivers, 'notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;
        return view('drivers.create')->with([ 'notifications' => $notifications]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $generator = new ComputerPasswordGenerator();

        $generator->setLowercase()->setNumbers(false)->setSymbols(false)->setLength(6);

        $password = $generator->generatePassword();


        $request->validate([
            'email' => 'required',
            
            'name' => 'required',
            'staff_num' => 'required',
            'phone_num' => 'required'
        ]);

        $driver = new User();
        $driver->name = $request->name;
        $driver->email = $request->email;
        $driver->user_type = 'driver';
        $driver->staff_num = $request->staff_num;
        $driver->phone_num = $request->phone_num;
        $driver->password = Hash::make($password);
        $driver->id_num = $request->id_num;

        
        

        if ($driver->save()) {

            Notification::send($driver, new GeneratedPassword($password));


            return redirect()->route('drivers.index')->with('success', 'Driver Added Successfully');
        }

        return redirect()->route('drivers.index')->with('unsuccess', 'A problem occured please try again later');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = User::find($id);

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('drivers.edit')->with(['driver'=> $driver, 'notifications' => $notifications]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'emai' => 'requred',
            'staff_num' => 'required'
        ]);

        $driver = User::find($id);
        $driver->name = $request->name;
        $driver->email = $request->email;
        $driver->user_type = 'driver';
        $driver->staff_num = $request->staff_num;
        $driver->phone_num = $request->phone_num;
        $driver->id_num = $request->id_num;


        if ($driver->update()) {
            return redirect()->route('drivers.index')->with('success', 'Driver Details Updated Successfully');
        }
        
        return redirect()->route('drivers.index')->with('unsuccess', 'A problem occured please try again later');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        
        $driver = User::find($id);

        //dd($driver);

        $vehicle = Vehicle::where('driver_id', '=', $driver->id)->first();

        if ($vehicle) {
            $vehicle->driver_id = null;
            $vehicle->update();
        }
        

        if($driver->delete()) {
            return redirect()->route('drivers.index')->with('success', 'Driver deleted Successfully');
        }

    }

    public function myStudents()
    {
        $driver = Auth::user()->id;

        $vehicle = Vehicle::where('driver_id', '=', $driver)->first();

        if (! $vehicle) {
            return redirect()->back()->with('unsuccess', 'driver is not assigned vehicle');
        }

        $students = Student::where('vehicle_id', '=', $vehicle->id)->get();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('drivers.mystudents')->with([
            'students' => $students,
            'notifications' => $notifications
        ]);
    }
}
