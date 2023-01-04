<?php

namespace App\Http\Controllers;

use App\Geofence;
use App\Route;
use App\RoutePolyline;
use App\Trip;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::all();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;


        return view('routes.index')->with(['routes'=> $routes, 'notifications' => $notifications]);
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
        
        return view('routes.create')->with([
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
        $request->validate([
           'title' => 'required',
           'description' => 'required',
           'price' => 'required',
        ]);

        $route = new Route();
        $route->title = $request->title;
        $route->description = $request->description;
        $route->price = $request->price;

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;
        
        if($route->save()) {
            
            return redirect()->route('polyline', $route->id)->with([
                'success' => 'Route Added Successfuly, add geo fence to route',
                
            ]);
        }

        return redirect()->route('routes.index')->with('unsuccess', 'Something Went Wrong Please Try Again Later');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = Route::find($id);

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('routes.edit')->with(['route'=> $route, 'notifications' => $notifications]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           'title' => 'required',
           'description' => 'required',
           'price' => 'required',
        ]);

        $route = Route::find($id);
        $route->title = $request->title;
        $route->description = $request->description;
        $route->price = $request->price;
        if($route->update()) {
            return redirect()->route('routes.index')->with('success', 'Route Updated Successfuly');
        }

        return redirect()->route('routes.index')->with('unsuccess', 'Something Went Wrong Please Try Again Later');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route = Route::find($id);

        

        $polyLines = RoutePolyline::where('route_id', '=', $route->id)->get();
        $trips = Trip::where('route_id', '=', $route->id)->get();

        $vehicle = Vehicle::where('route_id', '=', $route->id)->first();



        if ($vehicle) {
            $vehicle->route_id = null;
            $vehicle->update();
        }


        foreach ($trips as $trip) {
            $trip->delete();
        }


        foreach ($polyLines as $polyLine) {
            $polyLine->delete();
        }

        if ($route->delete()) {
            return redirect()->route('routes.index')->with(['success' => 'route deleted successfully']);
        }
        return redirect()->route('routes.index')->with(['unsuccess' => 'System error please try again']);


    }
}
