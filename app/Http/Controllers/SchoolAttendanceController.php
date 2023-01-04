<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Notifications\StudentAbsent;
use App\Notifications\StudentAttend;
use App\SchoolAttendance;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class SchoolAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');

        $attendanceAm = SchoolAttendance::where('created_at', 'LIKE', '%'. $date .'%')->where('route_time', 'LIKE', 'am')->get();
        $attendancePm = SchoolAttendance::where('created_at', 'LIKE', '%'. $date .'%')->where('route_time', 'LIKE', 'pm')->get();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('school_attendance.index')->with(['attendanceAm' => $attendanceAm, 'attendancePm' => $attendancePm, 'notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = date('Y-m-d');

        $teacher = Auth::user();

    

        
        if ($teacher->user_type != 'teacher') {
            return redirect()->route('attendances.index')->with('unsuccess', 'Current user cannot mark attendance');
        }
        
        


        $attendanceAm = Attendance::where('created_at', 'LIKE', '%'. $date .'%')
                                    ->where('route_time', 'LIKE', 'am')
                                    ->where('present', '=', 1)
                                    ->where('grade', 'LIKE', $teacher->grade)
                                    ->get();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('school_attendance.create')->with(['attendanceAm' => $attendanceAm, 'notifications' => $notifications]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        $len = count($request->student_id);

    
        
        for ($i=0; $i < $len; $i++) { 
          
                $attendance = new SchoolAttendance();
                $attendance->vehicle_id = $request->vehicle_id[$i];
                $attendance->route_time = 'am';
                $attendance->student_id = $request->student_id[$i];
                $attendance->present = $request->present[$i];
                $attendance->save();

                $student = Student::find($request->student_id[$i]);

                $user = User::find($student->parent_id);

                if ($request->present[$i] == 1) {
                    Notification::send($user, new StudentAttend());
                } else {
                    Notification::send($user, new StudentAbsent());
                }
                
            
        }

        return redirect()->route('school-attendance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SchoolAttendance  $schoolAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolAttendance $schoolAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SchoolAttendance  $schoolAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolAttendance $schoolAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SchoolAttendance  $schoolAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolAttendance $schoolAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SchoolAttendance  $schoolAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolAttendance $schoolAttendance)
    {
        //
    }
}
