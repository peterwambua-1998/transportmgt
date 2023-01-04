<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated()
    {
        if(Auth::user()->user_type == 'parent'){

            
            
            $parent = Auth::user();

            
            $pNofitications = User::find($parent->id)->unreadNotifications;
    
            
            
            $numOfNotifications = count($pNofitications); 

            if ($parent->password_changed == false) {
                return redirect()->route('changepass');
            }

            return redirect()->route('phome')->with([
                'pNofitications' => $pNofitications,
                'numOfNotifications' => $numOfNotifications
            ]);
        }

        if(Auth::user()->user_type == 'office staff'){
            if (Auth::user()->password_changed == false) {
                return redirect()->route('changepass');
            }

            $pNofitications = Auth::user()->unreadNotifications;
    
            
            $numOfNotifications = count($pNofitications); 

            return redirect()->route('home');
        }

        if(Auth::user()->user_type == 'admin'){

            $pNofitications = Auth::user()->unreadNotifications;
    
            
            $numOfNotifications = count($pNofitications); 
            if (Auth::user()->password_changed == false) {
                return redirect()->route('changepass');
            }

            return redirect()->route('home');
        }

        if(Auth::user()->user_type == 'supervisor'){
            $pNofitications = Auth::user()->unreadNotifications;
    
            
            $numOfNotifications = count($pNofitications); 
            if (Auth::user()->password_changed == false) {
                return redirect()->route('changepass');
            }

            return redirect()->route('home');
        }

        if(Auth::user()->user_type == 'manager'){

            $pNofitications = Auth::user()->unreadNotifications;
    
            
            $numOfNotifications = count($pNofitications); 
            if (Auth::user()->password_changed == false) {
                return redirect()->route('changepass');
            }

            return redirect()->route('home');
        }

        if(Auth::user()->user_type == 'office_executive'){

            $pNofitications = Auth::user()->unreadNotifications;
    
            
            $numOfNotifications = count($pNofitications); 
            if (Auth::user()->password_changed == false) {
                return redirect()->route('changepass');
            }

            return redirect()->route('home');
        }

        if(Auth::user()->user_type == 'driver'){
            if (Auth::user()->password_changed == false) {
                return redirect()->route('changepass');
            }

            $pNofitications = Auth::user()->unreadNotifications;
    
            
            $numOfNotifications = count($pNofitications); 
            return redirect()->route('driver_mystudents');
        }

        if(Auth::user()->user_type == 'teacher'){
            if (Auth::user()->password_changed == false) {
                return redirect()->route('changepass');
            }
            $pNofitications = Auth::user()->unreadNotifications;
    
            
            $numOfNotifications = count($pNofitications); 
            
            return redirect()->route('school-attendance.create');
        }

    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
