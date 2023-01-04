<?php

namespace App\Http\Controllers;

use App\EmailSettings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailSettingsController extends Controller
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
        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

      

        return view('settings.create')->with([
            'notifications' => $notifications,
           
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
            'name' => 'required'
        ]);

        $isSettings = EmailSettings::find(1);
        if (! $isSettings) {
            $settings = new EmailSettings();
            $settings->name = $request->name;
            $settings->email = $request->email;
           
            if ($settings->save()) {
                return redirect()->back()->with('success', 'Success, your email settings have been saved.');
            
            }
        } else {
            $isSettings->name = $request->name;
            $isSettings->email = $request->email;


            if ($isSettings->update()) {
                return redirect()->back()->with('success', 'Success, your email settings have been saved.');
            
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmailSettings  $emailSettings
     * @return \Illuminate\Http\Response
     */
    public function show(EmailSettings $emailSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailSettings  $emailSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailSettings $emailSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailSettings  $emailSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailSettings $emailSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailSettings  $emailSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailSettings $emailSettings)
    {
        //
    }
}
