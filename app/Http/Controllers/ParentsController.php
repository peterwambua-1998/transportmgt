<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Notifications\ToParent;
use App\Receipt;
use App\Student;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = User::where('user_type', 'LIKE', 'parent')->get();

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        $parent = Auth::user();



        return view('parents.index')->with(['parents' => $parents, 'notifications' => $notifications]);
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


        $parent = User::find($id);

        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;


        return view('parents.edit')->with([
            'parent' => $parent,
            'notifications' => $notifications
        ]);
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
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_num' => 'required',
            
        ]);

        $parent = User::find($id);
        $parent->name = $request->name;
        $parent->email = $request->email;
        
        $parent->phone_num = $request->phone_num;
       
        if (! $request->password) {
            
            $parent->password = $parent->password;
        } else {
            $parent->password = $request->password;
        }
        
        if($parent->update()){
            return redirect()->route('parents.index')->with('success', 'Record updated successfully');
        };

        return redirect()->back()->with('unsuccess', 'Sytem error please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $parent = User::find($id);

        
        $invoices = Invoice::where('parent_id', '=', $parent->id)->get();
        $receipts = Receipt::where('parent_id', '=', $parent->id)->get();
        $students = Receipt::where('parent_id', '=', $parent->id)->get();

        foreach ($invoices as $invoice) {
            $invoice->parent_id = null;
            $invoice->update();
        }

        foreach ($receipts as $receipt) {
            $receipt->parent_id = null;
            $receipt->update();
        }

        foreach ($students as $student) {
            $student->parent_id = null;
            $student->update();
        }


        foreach ($parent->notifications  as $notification) {
            $notification->delete();
        }



        if($parent->delete()){
            return redirect()->back()->with('success', 'record deleted successfully');
        }

        return redirect()->back()->with('unsuccess', 'Sytem error please try again later');
    }

    public function phome() {

        $parent = Auth::user();

        $pNofitications = User::find($parent->id)->unreadNotifications;

        $students = Student::where('parent_id', '=', $parent->id)->get();

        
        
        $numChild = count($students);

        

        $numOfNotifications = count($pNofitications);

        return view('parentlogin.home')->with([
            'students' => $students,
            'numChild' => $numChild,
            'pNofitications' => $pNofitications,
            'numOfNotifications' => $numOfNotifications,
            
        ]);
    }

    public function getLangLong(Request $request)
    {
        $parent = User::find($request->pid);

        $students = Student::where('parent_id', '=', $parent->id)->get();

        

        $loc = ["lat" => [], "lng" => [], "label" => []];

        foreach ($students as $student) {
            array_push($loc["lat"], $student->vehicle->latitude);
            array_push($loc["lng"], $student->vehicle->longitude);
            array_push($loc["label"], $student->vehicle->title);
        }
        
        return response($loc);
    }

    public function myChildren($id) {
        $students = Student::where('parent_id', '=', $id)->get();

        $numChild = count($students);


        $parent = Auth::user();

        $pNofitications = User::find($parent->id)->unreadNotifications;



        $numOfNotifications = count($pNofitications);

        return view('parentlogin.children')->with([
            'students' => $students,
            'numChild' => $numChild,
            'pNofitications' => $pNofitications,
            'numOfNotifications' => $numOfNotifications
        ]);
    }

    public function paidInv($id){
        $invoices = Invoice::where('parent_id', '=', $id)->get();


        $parent = Auth::user();

        $pNofitications = User::find($parent->id)->unreadNotifications;



        $numOfNotifications = count($pNofitications);

        return view('parentlogin.pinvoice')->with([
            'invoices' => $invoices,
            'pNofitications' => $pNofitications,
            'numOfNotifications' => $numOfNotifications
        ]);
    }

    public function unpaidInv($id)
    {
        $invoices = Invoice::where('parent_id', '=', $id)->get();

        $parent = Auth::user();

        $pNofitications = User::find($parent->id)->unreadNotifications;

       

        $numOfNotifications = count($pNofitications);

        return view('parentlogin.unpinvoice')->with([
            'invoices' => $invoices,
            'pNofitications' => $pNofitications,
            'numOfNotifications' => $numOfNotifications
        ]);
    }

    
    

    public function getNotification()
    {
        $parent = Auth::user();

        $pNofitications = User::find($parent->id)->unreadNotifications;

       

        $numOfNotifications = count($pNofitications);

        return view('parents.seenotification')->with([
            'pNofitications' => $pNofitications,
            'numOfNotifications' => $numOfNotifications
        ]);
    }


    public function markAsRead($id)
    {
        $notification = DatabaseNotification::find($id);

        $notification->markAsRead();

        return redirect()->back();
    }

    public function addChildView($id)
    {
        $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;

        $parent = User::find($id);

        $vehicles = Vehicle::all();

        return view('parents.addchild')->with([
            'parent' => $parent,
            'vehicles' => $vehicles,
            'notifications' => $notifications
        ]);
    }

    public function addChild(Request $request)
    {
    
        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'grade' => 'required',
            'vehicle_id' => 'required'
        ]);


        $student = new Student();
        $student->vehicle_id = $request->vehicle_id;
        $student->parent_id = $request->parent_id;
        $student->first_name = $request->fname;
        $student->last_name  = $request->lname;
        $student->grade  = $request->grade;
        
        if ($student->save()) {
            return redirect()->route('parents.index')->with('success', 'Child added successfully');
        }

        return redirect()->route('parents.index')->with('unsuccess', 'System error please try again later');

    }
}
