<?php

use App\Attendance;
use App\Http\Controllers\SettingsController;
use App\Invoice;
use App\Mail\MonthlyInvoiceMail;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/geo-fence', 'GeofenceController@create')->name('geofence_create');
Route::get('/geo-fence-add/{id}', 'GeofenceController@add')->name('geofence_add');
Route::get('/show-geo-fence/{id}', 'GeofenceController@index')->name('geofence_show');
Route::post('/store-geo-fence', 'GeofenceController@store')->name('geofence_store');
Route::get('/edit-geo-fence/{id}', 'GeofenceController@edit')->name('geofence_edit');
Route::post('/update-geo-fence/{id}', 'GeofenceController@update')->name('geofence_update');


Route::get('/email', function () {
    $invoice = new Invoice();

    return new MonthlyInvoiceMail($invoice, 200);
});

Auth::routes();

Route::resource('vehicles', 'VehicleController');
Route::resource('drivers', 'DriverController');
Route::resource('routes', 'RouteController');
Route::resource('students', 'StudentController');
Route::resource('parents', 'ParentsController');
Route::resource('settings', 'SettingsController');
Route::resource('attendances', 'AttendanceController');
Route::resource('trips', 'TripController')->except('destroy');


//student change pick up if yes or no
Route::post('/change-pickup/{id}', 'StudentController@puckUp')->name('pick_up');

Route::post('/trips/destroy/{id}', 'TripController@destroy')->name('trip_destroy');


Route::get('/trips/create/{id}', 'TripController@myCreate')->name('trips_create');
Route::get('/vehicle/trips/{id}', 'TripController@getVehicleTrip')->name('get_vehicle_trips');


Route::get('/allstds', 'StudentController@allstd')->name('allstds');

//staff
Route::get('/staff', 'StaffController@index')->name('staff_index');
Route::get('/staff/create', 'StaffController@create')->name('staff_create');
Route::post('/staff/store', 'StaffController@store')->name('staff_store');
Route::get('/staff/edit/{id}', 'StaffController@edit')->name('staff_edit');
Route::patch('/staff/update/{id}', 'StaffController@update')->name('staff_update');
Route::get('/notification/pnotif', 'StaffController@notificationView')->name('pnotification_view');
Route::post('/notification/pnotify/send', 'StaffController@sendNotification')->name('pnotification_send');
Route::get('/notification/markasread/staff/{id}', 'StaffController@markAsRead')->name('notification_read');
Route::get('/notification/seenotify', 'StaffController@getNotification')->name('notification_get');
Route::get('/notification/all', 'AllNotificationsController@index')->name('all_notications');

//parent login
Route::get('/phome', 'ParentsController@phome')->name('phome');
Route::post('/getlatlong', 'ParentsController@getLangLong')->name('getlatlong');
Route::get('/children/{id}', 'ParentsController@myChildren')->name('pchildren');
Route::get('/pinvoices/paid/{id}', 'ParentsController@paidInv')->name('pinvoice');
Route::get('/unpinvoices/unpaid/{id}', 'ParentsController@unpaidInv')->name('unpinvoice');
Route::get('/addchildview/{id}', 'ParentsController@addChildView')->name('addchildview');
Route::post('/addchild', 'ParentsController@addChild')->name('addchild');

//invoice
Route::get('/invoices', 'InvoiceController@invoiceAll')->name('invoice_all');
Route::get('/invoices/getdata', 'InvoiceController@index')->name('invoice_index');
Route::get('/invoices/paid', 'InvoiceController@paid')->name('invoice_paid');
Route::get('/invoices/unpaid', 'InvoiceController@unPaid')->name('invoice_unpaid');
Route::get('/invoices/unpaid/data', 'InvoiceController@unpaidData')->name('unpaiddata');
Route::post('/invoices/unpaid/query', 'InvoiceController@unpaidDataQuery')->name('unpaiddataquery');

Route::get('/invoices/paid/data', 'InvoiceController@paidData')->name('paiddata');
Route::post('/invoices/paid/query', 'InvoiceController@paidDataQuery')->name('paiddataquery');
Route::post('/invoices/store', 'InvoiceController@store')->name('invoice_store');
Route::post('/invoices/search', 'InvoiceController@search')->name('invoice_search');

//vehicle tracker
Route::get('/tracker', 'TrackerController@index')->name('tracker');
Route::get('/allvehicles', 'TrackerController@allVehicles')->name('all_vehicles');
Route::post('/getvehicle','TrackerController@getVehicle')->name('get_vehicle');
Route::post('/vehicleoutofzone', 'VehicleController@outOfFence')->name('vehicleoutofzone');

//parent

Route::get('/pnotification/pseenotify', 'ParentsController@getNotification')->name('pnotification_get');
Route::get('/markasread/{id}', 'ParentsController@markAsRead')->name('pnotification_read');
Route::post('/pcheckout', 'CheckoutController@index')->name('pcheckout');
Route::post('/checkout', 'CheckoutController@store')->name('checkout');
Route::get('/chargeupdate/{id}', 'CheckoutController@myupdate')->name('chekout_update');

//driver
Route::get('/mystudents', 'DriverController@myStudents')->name('driver_mystudents');

//change pass
Route::get('/change', 'HomeController@changepass')->name('changepass');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

//api
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/token', 'HomeController@personalToken');

//message settings
Route::post('/msg-store', 'DefaultMessageSettingController@store')->name('msg-store');

//payment gateway
Route::get('/get-key', 'CheckoutController@getKey')->name('getkey');
Route::post('/paygate-store', 'PaymentGatewaySettingController@store')->name('paygate-store');


//reports 
Route::get('/attendance-report', 'ReportsController@attendance')->name('att-report');
Route::get('/attendance-report-table', 'ReportsController@getAttendance')->name('attendance-report-table');
Route::post('/attendance-report-query', 'ReportsController@getAttendanceQuery')->name('attendance-report-query');

//financial reports
Route::get('/finance-report', 'ReportsController@financialView')->name('financialview');
Route::get('/finance-report-data', 'ReportsController@getFinancial')->name('financialdata');
Route::post('/finance-report-query', 'ReportsController@queryFinancial')->name('financialquery');

/*
Route::get('/roles', function(){
    $user = User::find(1);

    $permissions = Permission::all();

    //give permissions by id
    //$user->permissions()->sync([1, 2, 5]);

    foreach ($user->permissions as $item) {
        var_dump($item->name);
    }

    
});*/


//home logic
Route::get('/header-data', 'HomeController@headerData')->name('header-data');
Route::get('/chart-data', 'HomeController@chartData')->name('chart-data');
Route::get('/officestaff-data', 'HomeController@officeStaff')->name('officestaff-data');
Route::get('/vehicle-staff-num', 'HomeController@vehicleStaffNum')->name('vehiclestaffnum');


//school attendance
Route::resource('/school-attendance', 'SchoolAttendanceController');


//routes maps
Route::get('/polyline', function () {
    $user = Auth::user();

        $notifications = User::find($user->id)->unreadNotifications;
    return view('routes.polyline')->with('notifications', $notifications);
});

Route::get('/polyline/{id}', 'RoutePolylineController@index')->name('polyline');
Route::get('/polyline-add/{id}', 'RoutePolylineController@create')->name('polyline_create');

Route::get('/polyline-edit/{id}', 'RoutePolylineController@edit')->name('polyline_edit');
Route::post('/polyline-update/{id}', 'RoutePolylineController@update')->name('polyline_update');

Route::post('/save-route-path/{id}', 'RoutePolylineController@store')->name('save-route-path');

Route::post('/polyline-delete', 'RoutePolylineController@destroy')->name('polyline-delete');

//profile settings
Route::get('/profile/{id}', 'ProfileController@show')->name('profile_show');
Route::post('/profile/update/{id}', 'ProfileController@update')->name('profile_update');


//email settings
Route::post('/settings/email', 'EmailSettingsController@store')->name('email_store');