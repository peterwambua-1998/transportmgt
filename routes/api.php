<?php

use App\Http\Controllers\api\v1\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/login', 'api\v1\LoginController@login');

Route::middleware('auth:api')->get('/getuser', 'api\v1\LoginController@getUser');
Route::middleware('auth:api')->get('/getstudents', 'api\v1\LoginController@getStudents');
Route::middleware('auth:api')->get('/getvehicle', 'api\v1\LoginController@getVehicle');
Route::middleware('auth:api')->get('/numstd', 'api\v1\LoginController@myStudentCount');


//Route::middleware('auth:api')->get('/all', 'api\v1\UserController@index');


Route::middleware('auth:api')->post('/attendance/store', 'api\v1\AttendanceController@store');