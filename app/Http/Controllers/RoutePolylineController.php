<?php

namespace App\Http\Controllers;

use App\Geofence;
use App\Route;
use App\RoutePolyline;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutePolylineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        $route = Route::find($id);

        return view('routes.polyline')->with([
            'notifications' => $notifications,
            'route' => $route
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $route = Route::find($id);

        $geoFence = Geofence::where('route_id', '=', $route->id)->first();

        if (! $geoFence) {
            return redirect()->back()->with('unsuccess', 'please add geo fence then add trips');
        }

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('routes.polyline')->with([
            'notifications' => $notifications,
            'route' => $route,
            'geofence' => $geoFence
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $route = Route::find($id);

        

        
            $routePolyline = new RoutePolyline();
            $routePolyline->route_id = $route->id;
            $routePolyline->origin = $request->origin;
            $routePolyline->destination = $request->destination;
            $routePolyline->way_point_1 = $request->waypoint_1;
            $routePolyline->way_point_2 = $request->waypoint_2;
            $routePolyline->way_point_3 = $request->waypoint_3;
            $routePolyline->way_point_4 = $request->waypoint_4;
            $routePolyline->way_point_5 = $request->waypoint_5;
            $routePolyline->way_point_6 = $request->waypoint_6;
            $routePolyline->way_point_7 = $request->waypoint_7;
            $routePolyline->way_point_8 = $request->waypoint_8;
        

        

        if ($routePolyline->save()) {
            return redirect()->route('routes.index')->with('success'. 'route path saved');
        }

        return redirect()->route('routes.index')->with('Syatem error please try again');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoutePolyline  $routePolyline
     * @return \Illuminate\Http\Response
     */
    public function show(RoutePolyline $routePolyline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoutePolyline  $routePolyline
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $polyline = RoutePolyline::find($id);

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('routes.editpolyline')->with([
            'polyline' => $polyline,
            'notifications' => $notifications
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoutePolyline  $routePolyline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        

        
            $routePolyline = RoutePolyline::find($id);
          
            $routePolyline->origin = $request->origin;
            $routePolyline->destination = $request->destination;
            $routePolyline->way_point_1 = $request->waypoint_1;
            $routePolyline->way_point_2 = $request->waypoint_2;
            $routePolyline->way_point_3 = $request->waypoint_3;
            $routePolyline->way_point_4 = $request->waypoint_4;
            $routePolyline->way_point_5 = $request->waypoint_5;
            $routePolyline->way_point_6 = $request->waypoint_6;
            $routePolyline->way_point_7 = $request->waypoint_7;
            $routePolyline->way_point_8 = $request->waypoint_8;
        

        

        if ($routePolyline->update()) {
            return redirect()->route('geofence_show', $routePolyline->route_id)->with('success', 'update was successful');
        }

        return redirect()->back()->with('unsuccess', 'Syatem error please try again');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoutePolyline  $routePolyline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $polyline = RoutePolyline::find($request->id);

        $polyline->delete();

        return response('delete successfull');
    }
}
