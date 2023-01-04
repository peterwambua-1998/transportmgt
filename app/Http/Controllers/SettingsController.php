<?php

namespace App\Http\Controllers;

use App\Settings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
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
            'company_name' => 'required'
        ]);

        $isSettings = Settings::find(1);
        if (! $isSettings) {
            $settings = new Settings();
            $settings->company_name = $request->company_name;
            $settings->company_pnum = $request->company_pnum;
            $settings->company_email = $request->company_email;
            $settings->company_address = $request->company_address;

            if ($request->hasFile('image')) {
                // Delete old image
                if ($settings->company_logo) {
                    Storage::delete($settings->company_logo);
                }

                // Store image
                $image_path = $request->file('image')->store('logo', 'public');

                // Save to Database
                $settings->company_logo = $image_path;
            }


            if ($settings->save()) {
                return redirect()->back()->with('success', 'Success, your settings have been saved.');
            
            }
        } else {
            $isSettings->company_name = $request->company_name;
            $isSettings->company_pnum = $request->company_pnum;
            $isSettings->company_email = $request->company_email;
            $isSettings->company_address = $request->company_address;


            if ($request->hasFile('image')) {
                // Delete old image
                if ($isSettings->company_logo) {
                    Storage::delete($isSettings->company_logo);
                }

                // Store image
                $image_path = $request->file('image')->store('logo', 'public');

                // Save to Database
                $isSettings->company_logo = $image_path;
            }


            if ($isSettings->update()) {
                return redirect()->back()->with('success', 'Success, your settings have been saved.');
            
            }
        }

        

        return redirect()->back()->with('unsuccess', 'System error try again later');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
