<?php

namespace App\Http\Controllers;

use App\Geofence;
use App\Notifications\VehicleOutOfFence;
use App\Route;
use App\Vehicle;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('vehicle.index')->with(['vehicles' => $vehicles, 'notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = Route::all();

        $drivers = User::where('user_type', 'LIKE', 'driver')->get();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;


        return view('vehicle.create')->with(['routes'=> $routes, 'drivers' => $drivers, 'notifications' => $notifications]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'platenum' => 'required',
            'driver' => 'required',
            'route' => 'required',
            'num_of_seats' => 'required'
        ]);


        $vehicle = new Vehicle();
        $vehicle->title = $request->title;
        $vehicle->plate_num = $request->platenum;
        $vehicle->driver_id = $request->driver;
        $vehicle->route_id = $request->route;
        $vehicle->num_of_seats = $request->num_of_seats;
        $vehicle->latitude = '-1.4387634';
        $vehicle->longitude = '36.9952405';

        $vehicle->save();

        $geofence = new Geofence();

        $geofence->vehicle_id = $vehicle->id;
        $geofence->arrone_first = $request->arrayone_first;
        $geofence->arrone_second = $request->arrayone_second;
        $geofence->arrtwo_first = $request->arraytwo_first;
        $geofence->arrtwo_second = $request->arraytwo_second;
        $geofence->arrthree_first = $request->arraythree_first;
        $geofence->arrthree_second = $request->arraythree_second;
        $geofence->arrfour_first = $request->arrayfour_first;
        $geofence->arrfour_second = $request->arrayfour_second;
        



        if ($geofence->save()) {
            return redirect()->route('vehicles.index')->with('success', 'Vehicle Saved To Fleet Successfuly');
        }

        return redirect()->back()->with('unsuccess', 'Something Went Wrong Please Try Again Later');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);

        $routes = Route::all();

        $drivers = User::where('user_type', 'LIKE', 'driver')->get();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;
        

        return view('vehicle.edit')->with([
            'vehicle'=> $vehicle,
            'routes' => $routes,
            'drivers' => $drivers,
            'notifications' => $notifications
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'platenum' => 'required',
            'driver' => 'required',
            'route' => 'required'
        ]);
        $vehicle = Vehicle::find($id);
        $vehicle->title = $request->title;
        $vehicle->plate_num = $request->platenum;
        $vehicle->driver_id = $request->driver;
        $vehicle->route_id = $request->route;
        $vehicle->num_of_seats = $request->num_of_seats;


        if($vehicle->update()) {
            return redirect()->route('vehicles.index')->with('success', 'Changes To Vehicle Was Added Successfuly');
        }

        return redirect()->back()->with('unsuccess', 'Something Went Wrong Please Try Again Later');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle Removed From Fleet');
    }


    public function outOfFence(Request $request)
    {
        $users = User::where('user_type', 'LIKE', 'office staff')
                        ->orWhere('user_type', 'LIKE', 'admin')
                        ->orWhere('user_type', 'LIKE', 'supervisor')
                        ->orWhere('user_type', 'LIKE', 'manager')
                        ->orWhere('user_type', 'LIKE', 'office_executive')
                        ->get();

        $vehicle = Vehicle::find($request->vehicle_id);
        $driver = User::find($vehicle->driver_id);

        Notification::send($users, new VehicleOutOfFence($vehicle->title, $vehicle->plate_num, $driver->name));

        return response('success');
        
    }

    
}
