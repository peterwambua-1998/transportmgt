<?php

namespace App\Http\Controllers;

use App\Notifications\GeneratedPassword;
use App\Notifications\ToParent;
use App\Staff;
use App\User;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use League\OAuth2\Server\Grant\PasswordGrant;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = User::where('user_type', 'LIKE', 'office staff')
                        ->orWhere('user_type', 'LIKE', 'admin')
                        ->orWhere('user_type', 'LIKE', 'supervisor')
                        ->orWhere('user_type', 'LIKE', 'manager')
                        ->orWhere('user_type', 'LIKE', 'office_executive')
                        ->orWhere('user_type', 'LIKE', 'teacher')
                        ->get();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('staff.index')->with(['staffs' => $staffs, 'notifications' => $notifications]);
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

        return view('staff.create')->with(['notifications' => $notifications]);
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
            'name' => 'required',
            'email' => 'required',
            'user_type' => 'required',
            'phone_num' => 'required',
            'staff_num' => 'required'
        ]);

        $staff = new User();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->user_type = $request->user_type;
        $staff->phone_num = $request->phone_num;
        $staff->staff_num = $request->staff_num;
        $staff->password = Hash::make($password);
        $staff->password_changed = 0;
        $staff->id_num = $request->id_num;

        if ($request->has('grade')) {
            $staff->grade = $request->grade;
        }

        Notification::send($staff, new GeneratedPassword($password));


        if($staff->save()){
            return redirect()->route('staff_index')->with('success', 'Record added successfully');
        };

        return redirect()->route('staff_index')->with('unsuccess', 'A problem occured please try again later');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = User::find($id);

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('staff.edit')->with(['staff' => $staff, 'notifications' => $notifications]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            
            'phone_num' => 'required',
            'staff_num' => 'required'
        ]);

        $staff = User::find($id);
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->user_type = $request->user_type;
        $staff->phone_num = $request->phone_num;
        $staff->staff_num = $request->staff_num;
        $staff->id_num = $request->id_number;
        $staff->grade = $request->grade;



        if($staff->update()){
            return redirect()->route('staff_index')->with('success', 'Record updated successfully');
        };

        return redirect()->route('staff_index')->with('unsuccess', 'A problem occured please try again later');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
    
    }

    public function notificationView()
    {
        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        $parents = User::where('user_type', 'LIKE', 'parent')->get();

        return view('parents.notification')->with(['notifications'=> $notifications, 'parents' => $parents]);
    }


    public function sendNotification(Request $request)
    {
        $parent = User::find($request->parent_id);

        $msgHeader = $request->msg_header;
        $msgBody = $request->msg_body;

        $parent->notify(new ToParent($msgHeader, $msgBody));

        return redirect()->back()->with('success', 'notification sent');
    }


    public function markAsRead($id)
    {
        $notification = DatabaseNotification::find($id);

        $notification->markAsRead();

        return redirect()->back();
    }


    public function getNotification()
    {
        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        $numOfNotifications = count($notifications);

        return view('staff.seenotification')->with([
            'notifications' => $notifications,
            'numOfNotifications' => $numOfNotifications
        ]);
    }
}
