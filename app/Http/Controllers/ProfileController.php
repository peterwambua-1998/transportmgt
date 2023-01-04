<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        $userProfile = User::find($id);

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('profile.show')->with([
            'userProfile' => $userProfile,
            'notifications' => $notifications
        ]);
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
        if (Auth::user()->user_type  == 'teacher') {
            # code...
            $userProfile = User::find($id);

            $notifications = $userProfile->unreadNotifications;

            $userProfile->name = $request->name;
            $userProfile->email = $request->email;
            $userProfile->phone_num = $request->phone_num;
            $userProfile->id_num = $request->id_num;
            $userProfile->grade = $request->grade;


            if ($request->has('password')) {
                $userProfile->password = Hash::make($request->password);
            }

            if ($userProfile->update()) {
                return redirect()->route('profile_show', $userProfile->id)->with([
                    'userProfile' => $userProfile,
                    'notifications' => $notifications
                ]);
            }
        } else {
             # code...
             $userProfile = User::find($id);

             $notifications = $userProfile->unreadNotifications;
 
             $userProfile->name = $request->name;
             $userProfile->email = $request->email;
             $userProfile->phone_num = $request->phone_num;
             $userProfile->id_num = $request->id_num;
             
 
 
             if ($request->has('password')) {
                 $userProfile->password = Hash::make($request->password);
             }
 
             if ($userProfile->update()) {
                 return redirect()->route('profile_show', $userProfile->id)->with([
                     'userProfile' => $userProfile,
                     'notifications' => $notifications
                 ]);
             }
        }
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
}
