<?php

namespace App\Http\Controllers\api\v1;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
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
    

        $num = count($request->vehicle_id);

     

        $vehicle_id = $request->vehicle_id;
        $route_time = $request->route_time;

        for ($i=0; $i < $num; $i++) { 
            # code...
        
            
        
            $attendance = new Attendance();
            $attendance->vehicle_id = $vehicle_id[$i];
            $attendance->student_id = $request->student_id[$i];
            $attendance->present = $request->present[$i];
            $attendance->route_time = $route_time[$i];

            $student = Student::find($request->student_id[$i]);
            $attendance->grade = $student->grade;

            if (! $attendance->save()) {
                return response('cannot perform action at this time');
            }
        }
        

        

        return response('data added');
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
}
