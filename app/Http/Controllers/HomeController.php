<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Student;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->user_type == 'office staff') {
            $notifications = User::find($user->id)->unreadNotifications;

            return view('home')->with('notifications', $notifications);
        } else {
            $notifications = User::find($user->id)->unreadNotifications;

            return view('home')->with('notifications', $notifications);
        }

        if ($user->user_type == 'parent') {
        
            
            $parent = Auth::user();

            $pNofitications = User::find($parent->id)->unreadNotifications;
    
    
            
            $numOfNotifications = count($pNofitications);

            return view('phome')->with([
                'pNofitications' => $pNofitications,
                'numOfNotifications' => $numOfNotifications
            ]);
        }
        
    }

    public function changepass()
    {
        $parent = Auth::user();

        $pNofitications = User::find($parent->id)->unreadNotifications;

        $numOfNotifications = count($pNofitications);

        return view('parents.changepassword')->with([
            'pNofitications' => $pNofitications,
            'numOfNotifications' => $numOfNotifications
        ]);
    }


    public function changePassword(Request $request)
    {
        
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
    
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
    
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
        ]);
    
        //Change Password
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->get('new-password'));
        $user->password_changed = 1;
        $user->update();

        
        if (Auth::user()->user_type == 'teacher') {
            return redirect()->route('school-attendance.create')->with("success","Password changed successfully !");
        } else if (Auth::user()->user_type == 'parent') {
            return redirect()->route('phome')->with("success","Password changed successfully !");
        } else {
            return redirect()->route('home')->with("success","Password changed successfully !");
        }
        
    }

    public function personalToken()
    {
        return view('personaltoken.index');
    }


    public function headerData()
    {
        $date = date('Y-m-d');
        $invoicesPaid = Invoice::where('status', '=', 'paid')->get();
        $invoicesUnpaid = Invoice::where('status', '=', 'unpaid')->get();

        $invoicesTodayPaid = Invoice::where('updated_at', 'LIKE', '%'. $date .'$')->where('status', '=', 'paid')->get();
        $invoicesTodayUnpaid = Invoice::where('created_at', 'LIKE', '%'. $date .'$')->where('status', '=', 'paid')->get();

        $totalPaid = 0;
        $totalUnpaid = 0;


        $totalTodayPaid = 0;
        $totalTodayUnpaid = 0;

        foreach ($invoicesPaid as $invoicePaid) {
            $totalPaid += $invoicePaid->amount;
        }


        foreach ($invoicesUnpaid as $invoiceUnpaid) {
            $totalUnpaid += $invoiceUnpaid->amount;
        }


        foreach ($invoicesTodayPaid as $invoiceTodayPaid) {
            $totalTodayPaid += $invoiceTodayPaid->amount;
        }

        foreach ($invoicesTodayUnpaid as $invoiceTodayUnpaid) {
            $totalTodayUnpaid += $invoiceTodayUnpaid->amount;
        }

        $studentsNum = count(Student::all());

        $parentsNum = count(User::where('user_type', '=', 'parent')->get());

        $unpaidCount = count($invoicesUnpaid);

        return response([
            'total_paid' => $totalPaid,
            'total_unpaid' => $totalUnpaid,
            'total_today_paid' => $totalTodayPaid,
            'total_today_unpaid' => $totalTodayUnpaid,
            'studentsNum' => $studentsNum,
            'parentsNum' => $parentsNum,
            'unpaidCount' => $unpaidCount
        ]);
    }


    public function chartData()
    {
        $monthArrays = ['01','02', '03', '04', '05', '06', '07', '08', '09','10', '11', '12'];

        $totals = [];

        $year = date('Y');


        foreach ($monthArrays as $monthArray) {
            $date = $year . '-' . $monthArray;

            $total = 0;


            $sales = Invoice::where('updated_at', 'LIKE', '%'. $date . '%')->where('status', '=', 'paid')->get();


            foreach ($sales as $sale) {
                $total += $sale->amount;
            }

            array_push($totals, $total);
        }

        return response(['totals' => $totals]);

    }


    public function officeStaff()
    {
        $officeStaffs = User::where('user_type', '=', 'office staff')->take(3)->get();

        $id = 0;
        $table = '';
        foreach ($officeStaffs as $officeStaff) {

            $table .= '<tr><td>' . $id++ .'</td>' . '<td>'. $officeStaff->name .'</td>' . '<td>'.$officeStaff->email.'</td>' . '<td>'. $officeStaff->phone_num .'</td>' . '<td>'. $officeStaff->staff_num .'</td>' . '<td>'. $officeStaff->id_num .'</td></tr>';
            
        }


        return response($table);
    }



    public function vehicleStaffNum()
    {
        $num = count(User::where('user_type', '=', 'office staff')->get());

        $vehicleNum = count(Vehicle::all());


        return response(['staff_num' => $num, 'vehicle_num' => $vehicleNum]);
    }
}
