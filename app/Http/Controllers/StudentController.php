<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Invoice;
use App\Notifications\GeneratedPassword;
use App\Student;
use App\User;
use App\Vehicle;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('students.index')->with(['students'=>$students, 'notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::all();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;


       

        return view('students.create')->with(['vehicles'=> $vehicles, 'notifications' => $notifications]);
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
            'parnt_name' => 'required',
            'parnt_email' => 'required',
            'parnt_phone' => 'required',
           
            'fname' => 'required',
            'lname' => 'required',
            'grade' => 'required',
            'vehicle_id' => 'required',
            'parnt_phone' => 'required'
        ]);

        DB::transaction(function () use ($request, $password) {
            $parent = new User();
            $parent->name = $request->parnt_name;
            $parent->user_type = 'parent';
            $parent->password = Hash::make($password);
            $parent->email = $request->parnt_email;
            $parent->phone_num = $request->parnt_phone;
            $parent->id_num = $request->id_num;
            
            $parent->save();

            Notification::send($parent, new GeneratedPassword($password));

            $numStd = count($request->fname);

            for ($i=0; $i < $numStd; $i++) { 
                $student = new Student();
                $student->vehicle_id = $request->vehicle_id[$i];
                $student->parent_id = $parent->id;
                $student->first_name = $request->fname[$i];
                $student->last_name = $request->lname[$i];
                $student->grade = $request->grade[$i];
                $student->add_num = $request->add_num[$i];
                $student->lat = $request->lat;
                $student->lng = $request->lng;
                $student->trip_id = $request->trip_id[$i];
                $student->save();
            }
        });
       
        
        return redirect()->route('students.index')->with('success', 'Record added Successfuly');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);

        $vehicle = Vehicle::where('id', '=', $student->vehicle_id)->first();

        $vehicles = Vehicle::all();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        return view('students.edit')->with([
            'student' => $student,
            'vehicle' => $vehicle,
            'vehicles' => $vehicles,
            'notifications' => $notifications
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'grade' => 'required',
            'vehicle_id' => 'required'
        ]);

        $student = Student::find($id);
        $student->vehicle_id = $request->vehicle_id;
        $student->first_name = $request->fname;
        $student->last_name = $request->lname;
        $student->grade = $request->grade;
        

        if ($student->update()) {
            return redirect()->route('students.index')->with('success', 'Record added Successfuly');
        }

        return redirect()->back()->with('unsuccess', 'Sytem error please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $student = Student::find($request->student_id);

        $attendances = Attendance::where('student_id', '=', $student->id)->get();
        $invoices = Invoice::where('student_id', '=', $student->id)->get();

        foreach ($invoices as $invoice) {
            $invoice->student_id = null;
            $invoice->update();
        }

        foreach ($attendances as $attendance) {
            $attendance->delete();
        }

        if($student->delete()){
            return redirect()->back()->with('success', 'record deleted successfully');
        }

        return redirect()->back()->with('unsuccess', 'Sytem error please try again later');


    }

    public function allstd()
    {
        $students = Student::with('parent', 'vehicle')->get();

        return response($students);
    }


    /**
     * change pick up from yes to no or viceverser
     */
    public function puckUp($id)
    {
        
    }
}
