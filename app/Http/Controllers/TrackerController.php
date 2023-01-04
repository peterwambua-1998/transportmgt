<?php

namespace App\Http\Controllers;

use App\Geofence;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $drivers = User::where('user_type', '=', 'driver')->get();

        

        $notifications = User::find($user->id)->unreadNotifications;
        return view('vehicle.track')->with([
            'notifications' => $notifications,
            'drivers' => $drivers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allVehicles()
    {
        $vehicles = Vehicle::all();

        $locations = [];

        $routes = [];

        $final = [];
        
        foreach($vehicles as $vehicle) {
            $arr = [$vehicle->latitude - 0, $vehicle->longitude - 0, $vehicle->id, $vehicle->title];

            $geofence = Geofence::where('vehicle_id', '=', $vehicle->id)->first();
            if ($geofence) {
                $arr2 = $geofence;
            }
        
            array_push($locations, $arr, $arr2);

            array_push($final, $locations);
            
        }
  
        return response($locations);
    }


    public function getVehicle(Request $request)
    {
        $vehicle = Vehicle::find($request->id);

        $driver = User::where('id', '=', $vehicle->driver_id)->first();

        $arr = [$vehicle, $driver];

        return response($arr);
    }
}
