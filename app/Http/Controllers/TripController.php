<?php

namespace App\Http\Controllers;

use App\Route;
use App\Trip;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
    }

    public function myCreate($id)
    {
        $route = Route::find($id);


        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('trips.create')->with([
            'route' => $route,
            'notifications' => $notifications
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trip = new Trip();
        $trip->route_id = $request->route_id;
        $trip->title = $request->title;
        $trip->time = $request->route_time;
        $trip->time_from = $request->from;
        $trip->time_to = $request->to;

        $route = Route::find($request->route_id);
        if($trip->save()) {
            return redirect()->route('geofence_show', $route->path->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $trip = Trip::find($id);

        if($trip->delete()) {
            return response(['success' => 'deleted trip successfully', 'unsuccess' => null]);
        } else {
            return response(['success' => null, 'unsuccess' => 'system error please try again']);
        }
    }


    public function getVehicleTrip ($id) {

        
        $vehicle = Vehicle::find($id);

        //$trips = $vehicle->route->trips;


        


        $myselect = "<label>Select Trip</label><select name='trip_id[]' id='' class='form-control'>";

        foreach ($vehicle->route->trip as $trips) {
            $myselect .= "<option value='$trips->id'>Title: $trips->title, AM/PM: $trips->time,  From: $trips->time_from,  To: $trips->time_to</option>";
        }

        $myselect .= '</select>';



        return response($myselect);
    }
}
